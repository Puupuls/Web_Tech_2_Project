<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->show(auth()->user()->id, true);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @param bool $passed
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id, $passed=false)
    {
        if(auth()->user()->id == $id && !$passed){
            return redirect()->route('user.index');
        }else if(auth()->user()->id == $id || auth()->user()->is_admin) {
            $user = User::findOrFail($id);
            return view('profile', ['user' => $user]);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if(auth()->user()->id == $id || auth()->user()->is_admin) {
            $user = User::findOrFail($id);
            return view('profile_edit', ['user' => $user]);
        }else{
            abort(404);
        }
    }

    public function edit_mortal()
    {
        return $this->edit(auth()->user()->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|alpha',
            'email' => 'required|email',
        );
        $this->validate($request, $rules);

        $users = User::where('id', '!=', $id)->where('email', '=', $request['email'])->get();
        if($users->count()) {
            $errors = ['email' => __('validation.unique', ['attribute' => __('auth.email_address')])];
            return redirect()->back()
                ->withInput($request->input())
                ->withErrors($errors);
        }

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        return redirect()->route('user.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
