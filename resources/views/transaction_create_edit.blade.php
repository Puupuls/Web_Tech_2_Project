@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{__('messages.transaction')}}</span>
                        <a href="{{route('income.index')}}" class="float-right ml-5">{{__('messages.edit_income_categories')}}</a>
                        <a href="{{route('expense.index')}}" class="float-right">{{__('messages.edit_expense_categories')}}</a>
                    </div>
                    {{Form::open(['action' => [$transaction? 'TransactionController@update' : 'TrackerController@store', $transaction->id?? ''], 'class' => 'form-horizontal', 'method'=>'POST']) }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-right">
                                {{__('messages.amount')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->amount ?? ''}}&euro;
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.category')}}:
                            </div>
                            <div class="col-6">
                                @if($transaction->is_income ?? '') {{$transaction->income_source->name ?? ''}} @else {{$transaction->expense_category->name ?? ''}} @endif
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.description')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->description ?? ''}}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.date')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->created_at ?? ''}}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.added_by')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->added_by->name ?? ''}}
                            </div>
                        </div>
                        <div class="justify-content-center row mt-5">
                            {{Form::submit($transaction? __('messages.update') : __('messages.add_new') , ["class"=>'btn btn-dark btn-outline-primary'])}}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
