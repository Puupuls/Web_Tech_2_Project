@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{$user->name}}</span>
                        <a href="{{auth()->user()->is_admin && auth()->user()->id != $user->id? route('user.edit', $user->id) : route('user.edit_mortal')}}" class="S float-right">{{__('edit')}}</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{__('auth.email_address')}}: {{$user->email}}
                    </div>
                </div>
                @if(count($user->trackers) > 0)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{__('messages.owned_trackers')}}
                        </div>
                        <div class="card-body">
                            @foreach($user->trackers as $tracker)
                                <a class="btn btn-dark" href="{{route('tracker.show', $tracker->id)}}">{{$tracker->name}}</a><br/>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($user->participates) > 0)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{__('messages.joined_trackers')}}
                        </div>
                        <div class="card-body">
                            @foreach($user->participates as $part)
                                <a class="btn btn-dark" href="{{route('tracker.show', $part->tracker->id)}}">{{$part->tracker->name}} ( {{$part->tracker->owner->name}} )</a><br/>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
