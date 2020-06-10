<?php

namespace App\Http\Controllers;

use App\Participant;
use App\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $success = false;
        $name = '';
        $new_id = 0;

        $user = User::where('email', $request['email'])->get();
        if($user->count() > 0 && $user[0]->id != auth()->user()->id){
            $part = Participant::where('tracker_id', $request['tracker_id'])->where('user_id', $user[0]->id)->get();
            if($part->count() == 0) {
                $success = true;
                $name = $user[0]->name;
                $part = Participant::create([
                    'user_id' => $user[0]->id,
                    'tracker_id' => $request['tracker_id']
                ]);
                $new_id = $part->id;
            }
        }

        return response()->json(['success'=>$success, 'name'=>$name, 'new_id'=>$new_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Participant $participant)
    {
        if(auth()->user()->id == $participant->tracker->owner_id){
            $participant->permissions = $request['can_edit']? 1 : 0;
            $participant->save();
        }
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Participant $participant)
    {
        if(auth()->user()->id == $participant->user->id || auth()->user()->id == $participant->tracker->owner_id) {
            $participant->delete();
            return response()->json(['success' => true]);
        }else{
            abort(403);
        }
    }
}
