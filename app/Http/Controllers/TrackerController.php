<?php

namespace App\Http\Controllers;

use App\Tracker;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        if(auth()->user()->last_tracker_id) {
            return $this->show(auth()->user()->last_tracker_id, true);
        }else{
            return redirect()->route('user.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('tracker_create_edit', ['tracker'=>[]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
        );
        $this->validate($request, $rules);

        $tracker = Tracker::create([
            'owner_id'=>auth()->user()->id,
            'name'=>$request['name']
        ]);
        return redirect()->route('tracker.show', $tracker->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $tracker
     * @param bool $passed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(int $tracker, $passed=false)
    {
        $tracker = Tracker::where('id', $tracker)->get();
        if($tracker->count()) {
            $tracker = $tracker[0];
            $is_participant = $tracker->is_participant(auth()->user());
            if (($is_participant || auth()->user()->id == $tracker->owner->id) && !$passed) {
                $user = auth()->user();
                $user->last_tracker_id = $tracker->id;
                $user->save();
                return redirect()->route('tracker.index');
            } else if (auth()->user()->id == $tracker->owner->id || $is_participant) {
                $stats = [
                    'expensesThisMonth' => $tracker->transactions()->
                        where('is_income', 0)->
                        whereBetween('created_at', [(new Carbon('first day of this month'))->setTime(0,0,0), Carbon::now()])->sum('amount'),
                    'incomeThisMonth' => $tracker->transactions()->
                        where('is_income', 1)->
                        whereBetween('created_at', [(new Carbon('first day of this month'))->setTime(0,0,0), Carbon::now()])->sum('amount'),
                    'balance' => $tracker->transactions()->
                        where('is_income', 1)->sum('amount') -
                        $tracker->transactions()->
                        where('is_income', 0)->sum('amount'),
                ];
                $stats['changeThisMonth'] = $stats['incomeThisMonth']-$stats['expensesThisMonth'];

                return view('tracker', ['tracker' => $tracker, 'stats' => $stats]);
            }
        }
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tracker $tracker
     * @return \Illuminate\Http\Response
     */
    public function edit(Tracker $tracker)
    {
        if(auth()->user()->id == $tracker->owner_id || auth()->user()->is_admin) {
            return view('tracker_create_edit', ['tracker' => $tracker]);
        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Tracker $tracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tracker $tracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tracker $tracker
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tracker $tracker)
    {
        if(auth()->user()->id == $tracker->owner_id || auth()->user()->is_admin) {
            if($tracker->owner->last_tracker_id == $tracker->id){
                $owner  =$tracker->owner;
                $owner->last_tracker_id = null;
                $owner->save();
            }
            foreach($tracker->participants as $part) $part->delete();
            foreach($tracker->transactions as $tr) $tr->delete();
            foreach($tracker->income_sources as $i) $i->delete();
            foreach($tracker->expense_categories as $e) $e->delete();
            $tracker->delete();
            return redirect('/');
        }else{
            abort(403);
        }
    }
}
