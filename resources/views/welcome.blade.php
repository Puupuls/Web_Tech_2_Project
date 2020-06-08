@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{__('messages.app_name')}}</div>
                    <div class="card-body">
                        {{__('messages.app_description')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
