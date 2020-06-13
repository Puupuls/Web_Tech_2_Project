@extends('layouts.app')

@section('content')
    <style>
        .hidden{
            display: none;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{__('messages.transaction')}}</span>
                        <a href="{{route('income.index')}}" class="float-right ml-3">{{__('messages.edit_income_categories')}}</a>
                        <a href="{{route('expense.index')}}" class="float-right ml-3">{{__('messages.edit_expense_categories')}}</a>
                        <a href="{{URL::previous()}}" class="float-right">{{__('messages.back')}}</a>
                    </div>
                    {{Form::open(['files'=>true, 'action' => [$transaction? 'TransactionController@update' : 'TransactionController@store', $transaction->id?? ''], 'class' => 'form-horizontal', 'method'=>'PUT']) }}
                    {{ Form::hidden('tracker_id', $tracker->id, ['class' => 'form-control'.($errors->has('amount') ? ' is-invalid' : '')]) }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-right">
                                {{__('messages.amount')}}(&euro;):
                            </div>
                            <div class="col-6">
                                {{ Form::number('amount', $transaction->amount??0, ['class' => 'form-control'.($errors->has('amount') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('amount'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4 text-right">
                                {{__('messages.is_income')}}:
                            </div>
                            <div class="col-6">
                                <input style="width: auto; margin-top:7px"
                                       class="form-control {{($errors->has('is_income') ? ' is-invalid' : '')}}"
                                       name="is_income"
                                       type="checkbox"
                                       value="is_income" {{$transaction->is_income??false? 'checked' : ''}}
                                        onclick="$('.cat').toggleClass('hidden')"
                                >
                                @if ($errors->has('is_income'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('is_income') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 text-right">
                                {{__('messages.category')}}:
                            </div>
                            <div class="col-6 cat {{$transaction->is_income??false? '' : 'hidden'}}">
                                {{ Form::select('income_source', $income_sources, $transaction->income_source_id?? null, ['class' => 'form-control'.($errors->has('income_source') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('income_source'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('income_source') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-4 cat {{$transaction->is_income??false? 'hidden' : ''}}">
                                {{ Form::select('expense_category', $expense_categories, $transaction->expense_category_id?? null,['class' => 'form-control'.($errors->has('expense_category') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('expense_category'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('expense_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 text-right">
                                {{__('messages.description')}}:
                            </div>
                            <div class="col-6">
                                {{ Form::text('description', $transaction->description??'',['class' => 'form-control'.($errors->has('description') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-4 text-right">
                                {{__('messages.image')}}:
                            </div>
                            <div class="col-6">
                                {{ Form::file('image',['accept'=>'image/*', 'class' => 'form-control btn btn-md'.($errors->has('image') ? ' is-invalid' : '')]) }}
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
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
