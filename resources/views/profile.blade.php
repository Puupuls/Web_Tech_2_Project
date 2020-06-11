@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{$user->name}}</span>
                        <a href="{{auth()->user()->is_admin && auth()->user()->id != $user->id? route('user.edit', $user->id) : route('user.edit_mortal')}}" class="float-right">{{__('messages.edit')}}</a>
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
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{__('messages.owned_trackers')}}</span>
                        @if(auth()->user()->id == $user->id)
                            <a href="{{route('tracker.create')}}" class="float-right">{{__('messages.add_new')}}</a>
                        @endif
                    </div>
                    <div class="card-body">
                        @foreach($user->trackers as $tracker)
                            <a class="btn btn-dark" href="{{route('tracker.show', $tracker->id)}}">{{$tracker->name}}</a><br/>
                        @endforeach
                    </div>
                </div>
                @if(count($user->participates) > 0)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{__('messages.joined_trackers')}}
                        </div>
                        <div class="card-body">
                            @foreach($user->participates as $part)
                                <div id='part-{{$part->id}}' class="row justify-content-between pl-3 pr-3">
                                    <a class="btn btn-dark" href="{{route('tracker.show', $part->tracker->id)}}">{{$part->tracker->name}} ( {{$part->tracker->owner->name}} )</a>
                                    @if(auth()->user()->id == $user->id)
                                        <a class="btn btn-dark" onclick="leave({{$part->id}})">{{__('messages.leave')}}</a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if(auth()->user()->id == $user->id)
        <script type="application/javascript">
            function leave(id){
                let url = `{{ action('ParticipantController@destroy', 1) }}`;
                url= url.substr(0, url.length-2) + '/' + id;
                console.log(url)
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: { participant_id: id, _token: CSRF_TOKEN },
                    success: function (data) {
                        $(`#part-${id}`).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        </script>
    @endif
@endsection
