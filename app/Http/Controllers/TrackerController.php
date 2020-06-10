<?php

namespace App\Http\Controllers;

use App\Tracker;
use Illuminate\Http\Request;

class TrackerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Tracker $tracker)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tracker  $tracker
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
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tracker $tracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tracker  $tracker
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Tracker $tracker)
    {
        if(auth()->user()->id == $tracker->owner_id || auth()->user()->is_admin) {
            if($tracker->owner->last_tracker_id == $tracker->id){
                $owner  =$tracker->owner;
                $owner->last_tracker_id = null;
                $owner->save;
            }
            foreach($tracker->participants as $part) $part->delete();
            $tracker->delete();
            return redirect('/');
        }else{
            abort(403);
        }
    }
}
