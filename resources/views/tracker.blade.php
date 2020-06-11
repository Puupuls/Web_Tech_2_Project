@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="" style="min-width: 1200px;">
                <div class="card mb-5">
                    <div class="card-header">
                        <span class="align-middle">{{$tracker->name}}</span>
                        @if($tracker->owner_id == auth()->user()->id)
                            <a href="{{route('tracker.edit', $tracker->id)}}" class="float-right">{{__('messages.edit')}}</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div style="min-width: 290px; display:flex; flex: 1;">
                                <div class="text-success" style="margin:0 auto; text-align: center">
                                    {{__('messages.income')}} <br/>
                                    {{$stats['incomeThisMonth']}}
                                </div>
                            </div>
                            <div class="text-danger" style="min-width: 290px; display:flex; flex: 1;">
                                <div style="margin:0 auto; text-align: center">
                                    {{__('messages.expenses')}} <br/>
                                    {{$stats['expensesThisMonth']}}
                                </div>
                            </div>
                            <div class="@if($stats['changeThisMonth'] > 0) text-success @elseif($stats['changeThisMonth'] < 0) text-danger @endif" style="min-width: 290px; display:flex; flex: 1;">
                                <div style="margin:0 auto; text-align: center">
                                    {{__('messages.monthly_change')}} <br/>
                                    {{$stats['changeThisMonth']}}
                                </div>
                            </div>
                            <div class="@if($stats['balance'] > 0) text-success @elseif($stats['balance'] < 0) text-danger @endif" style="min-width: 290px; display:flex; flex: 1;">
                                <div style="margin:0 auto; text-align: center">
                                    {{__('messages.balance')}} <br/>
                                    {{$stats['balance']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="min-width: 1200px;">
                    <div class="card-header row justify-content-between ml-0 mr-0">
                        <span class="align-middle">{{__('messages.transactions')}}</span>
                        @if(auth()->user()->can_edit_tracker($tracker))
                            <div class="row mr-2">
                                <a href="{{route('transaction.create')}}" class="float-right">{{__('messages.add_transaction')}}</a>
                            </div>
                        @endif
                    </div>
                    <div class="card-header bg-info">
                        <div class="row p-1 pl-2 pr-2">
                            <div style="min-width: 100px; display:flex; flex: 1;">
                                <div style="margin:0 auto">{{__('messages.amount')}}</div>
                            </div>
                            <div style="min-width: 290px; display:flex; flex: 3;">
                                <div style="margin:0 auto">{{__('messages.category')}}</div>
                            </div>
                            <div style="min-width: 380px; display:flex; flex: 4;">
                                <div style="margin:0 auto">{{__('messages.description')}}</div>
                            </div>
                            <div style="min-width: 200px; display:flex; flex: 2;">
                                <div style="margin:0 auto">{{__('messages.date')}}</div>
                            </div>
                            <div style="min-width: 200px; display:flex; flex: 2;">
                                <div style="margin:0 auto">{{__('messages.added_by')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        @if(count($tracker->transactions))
                            @foreach($tracker->transactions as $trans)
                                <div class="row rounded mt-1 p-2 @if($trans->is_income) bg-success @else bg-primary @endif" style="cursor: pointer" onclick="window.location = '{{route('transaction.show', $trans->id)}}'">
                                    <div style="min-width: 100px; display:flex; flex: 1;">
                                        <div style="margin:0 auto">{{$trans->amount}}&euro;</div>
                                    </div>
                                    <div style="min-width: 290px; display:flex; flex: 3;">
                                        <div style="margin:0 auto">@if($trans->is_income) {{$trans->income_source->name}} @else {{$trans->expense_category->name}} @endif</div>
                                    </div>
                                    <div style="min-width: 380px; display:flex; flex: 4;">
                                        <div style="margin:0 auto">{{$trans->description}}</div>
                                    </div>
                                    <div style="min-width: 200px; display:flex; flex: 2;">
                                        <div style="margin:0 auto">{{$trans->created_at}}</div>
                                    </div>
                                    <div style="min-width: 200px; display:flex; flex: 2;">
                                        <div style="margin:0 auto">{{$trans->added_by->name}}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row justify-content-center mt-3">{{__('messages.no_transactions')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
