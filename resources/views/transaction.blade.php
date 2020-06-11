@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="align-middle">{{__('messages.transaction')}}</span>
                        @if(auth()->user()->can_edit_tracker($transaction->tracker))
                            <a onclick="del()" href="#" class="float-right ml-2">{{__('messages.delete')}}</a>
                            <a href="{{route('transaction.edit', $transaction->id)}}" onclick="del()" class="float-right">{{__('messages.edit')}}</a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 text-right">
                                {{__('messages.amount')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->amount}}&euro;
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.category')}}:
                            </div>
                            <div class="col-6">
                                @if($transaction->is_income) {{$transaction->income_source->name}} @else {{$transaction->expense_category->name}} @endif
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.description')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->description}}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.date')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->created_at}}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-6 text-right">
                                {{__('messages.added_by')}}:
                            </div>
                            <div class="col-6">
                                {{$transaction->added_by->name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->can_edit_tracker($transaction->tracker))
        <form id="delete-form" action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" style="display: none;">
            @csrf
            @method('delete')
        </form>
        <script type="application/javascript">
            function del(){
                event.preventDefault();
                document.getElementById('delete-form').submit();
            }
        </script>
    @endif
@endsection
