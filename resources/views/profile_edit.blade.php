@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{__('messages.edit_profile')}}</div>
                    <div class="card-body">
                        {{Form::open(['action' => ['UserController@update', $user->id], 'class' => 'form-horizontal', 'method'=>'patch']) }}
                        <div class="form-group row">
                            {{ Form::label('name', __('auth.name').':', ['class' => 'col-md-4 control-label text-md-right mb:0', 'style'=>'line-height:1.5; padding-top: 0.375rem;']) }}
                            <div class="col-md-6">
                                {{ Form::text('name', $user->name, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', __('auth.email_address').':', ['class' => 'col-md-4 control-label text-md-right mb:0', 'style'=>'line-height:1.5; padding-top: 0.375rem;']) }}
                            <div class="col-md-6">
                                {{ Form::email('email', $user->email, ['class' => 'form-control'.($errors->has('email') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback ">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row justify-content-center">
                            {{Form::submit(__('messages.update'), ["class"=>'btn btn-dark btn-outline-primary'])}}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
