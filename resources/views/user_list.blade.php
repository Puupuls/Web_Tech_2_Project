@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{__('messages.users')}}</span>
                    </div>
                    <div class="card-body">
                        @if($users)
                            @foreach($users as $user)
                                <div style="cursor: pointer" onclick="window.location={{route('user.show', $user->id)}}" class="row rounded mt-2 p-2 mx-5 {{$user->is_admin? 'bg-info' : 'bg-primary'}}">
                                    {{$user->email}} - {{$user->name}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
