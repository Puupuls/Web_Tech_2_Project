@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{Form::open(['action' => [$tracker? 'TrackerController@update' : 'TrackerController@store', $tracker->id?? ''], 'class' => 'form-horizontal', 'method'=>'POST']) }}
                <div class="card mb-3">
                    <div class="card-header">{{$tracker? __('messages.edit_tracker') : __('messages.add_new_tracker')}}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            {{ Form::label('name', __('messages.title').':', ['class' => 'col-md-4 control-label text-md-right mb:0', 'style'=>'line-height:1.5; padding-top: 0.375rem;']) }}
                            <div class="col-md-6">
                                {{ Form::text('name', $tracker->name ?? '', ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row justify-content-around mb-5">
                    {{Form::submit($tracker? __('messages.update') : __('messages.add_new') , ["class"=>'btn btn-dark btn-outline-primary'])}}

                    @if($tracker)
                        <a class="btn btn-dark btn-outline-primary" href="#"
                           onclick="del()" >{{__('messages.delete_tracker')}}</a>
                    @endif
                </div>
                {{ Form::close() }}

                @if($tracker)
                    <div class="card mb-3">
                        <div class="card-header">{{__('messages.manage_participants')}}</div>
                        <div class="card-body" id="participant-list">
                            @if(auth()->user()->id == $tracker->owner_id)
                                <div class="row mb-3">
                                    <label for="participant-email" class="col-md-4 control-label text-md-right mb:0" style="line-height:1.5; padding-top: 0.375rem;">{{__('auth.email_address')}}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" name="email" type="text" value="" id="participant-email">
                                    </div>
                                    <div class="col-md-2">
                                        <a class="btn btn-dark right" onclick="add()">{{__('messages.add')}}</a>
                                    </div>
                                </div>
                            @endif
                            @foreach($tracker->participants as $part)
                                <div class="row justify-content-between row pl-3 pr-3" id="part-{{$part->id}}">
                                    <span class="align-middle">{{$part->user->name}} ({{$part->user->email}})</span>
                                    <span>
                                        <label for="can-edit-{{$part->id}}"> {{__('messages.can_edit')}} </label>
                                        <input type="checkbox" name="can-edit" onclick="toggle_can_edit({{$part->id}})" id="can-edit-{{$part->id}}" @if($part->permissions) checked @endif @if(auth()->user()->id != $tracker->owner_id) disabled @endif/>
                                    </span>
                                    <div>
                                        <a class="btn btn-dark align-middle" onclick="remove({{$part->id}})">{{__('messages.remove')}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if($tracker)
        <form id="delete-form" action="{{ route('tracker.destroy', $tracker->id) }}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
    @endif
    <script type="application/javascript">
        @if($tracker && (auth()->user()->id == $tracker->owner_id || auth()->user()-is_admin))
        function del(){
            if(confirm(`{{__('messages.are_you_sure_delete')}}`)) {
                event.preventDefault();
                document.getElementById('delete-form').submit();
            }
        }
        @endif
        @if($tracker && auth()->user()->id == $tracker->owner_id)

        function remove(id){
            let url = `{{ action('ParticipantController@destroy', 1) }}`;
            url= url.substr(0, url.length-2) + '/' + id;
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

        function add(){
            let email = $('#participant-email')[0].value;

            let url = `{{ action('ParticipantController@store') }}`;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: url,
                data: { email: email, _token: CSRF_TOKEN, tracker_id:{{$tracker->id}}},
                success: function (data) {
                    if(data.success){
                        document.getElementById('participant-list').innerHTML += `
                            <div class="row justify-content-between row pl-3 pr-3" id="part-${data.new_id}">
                                <span class="align-middle">${data.name} (${email})</span>
                                <span>
                                    <label for="can-edit-${data.new_id}"> {{__('messages.can_edit')}} </label>
                                    <input type="checkbox" name="can-edit" onclick="toggle_can_edit(${data.new_id})" id="can-edit-${data.new_id}"/>
                                </span>
                                <div>
                                    <a class="btn btn-dark align-middle" onclick="remove(${data.new_id})">{{__('messages.remove')}}</a>
                                </div>
                            </div>
                        `
                    }else{
                        alert('{{__('messages.could_not_add_participant')}}')
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function toggle_can_edit(id){
            let checked = $('#can-edit-'+id)[0].checked;

            let url = `{{ action('ParticipantController@update', 1) }}`;
            url= url.substr(0, url.length-2) + '/' + id;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "PATCH",
                url: url,
                data: { _token: CSRF_TOKEN, can_edit: checked },
                success: function (data) {

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
        @endif
    </script>
@endsection
