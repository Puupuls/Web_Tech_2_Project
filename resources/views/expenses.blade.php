@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($tracker)
                    <div class="card mb-3">
                        <div class="card-header">{{__('messages.manage_expense_categories')}}</div>
                        <div class="card-body" id="participant-list">
                            <div class="row mb-3">
                                <label for="expense-name" class="col-md-4 control-label text-md-right mb:0" style="line-height:1.5; padding-top: 0.375rem;">{{__('auth.name')}}</label>
                                <div class="col-md-6">
                                    <input class="form-control" name="exp" type="text" value="" id="expense-name">
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-dark right" onclick="add()">{{__('messages.add')}}</a>
                                </div>
                            </div>
                            @foreach($tracker->expense_categories as $i)
                                <div class="row justify-content-around row col-8 mt-2 ml-auto mr-auto" id="exp-{{$i->id}}">
                                    <input class="align-middle" value="{{$i->name}}" required name="exp-{{$i->id}}" id="exp-inp-{{$i->id}}" />
                                    <a class="btn btn-outline-primary" onclick="update({{$i->id}})">{{__('messages.update')}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script type="application/javascript">
        @if(auth()->user()->can_edit_tracker($tracker))

        function add(){
            let name = $('#expense-name')[0].value;

            let url = `{{ action('ExpenseCategoryController@store') }}`;
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "POST",
                url: url,
                data: { name: name, _token: CSRF_TOKEN, tracker_id:{{$tracker->id}}},
                success: function (data) {
                    if(data.success){
                        document.getElementById('participant-list').innerHTML += `
                            <div class="row justify-content-around row col-8 mt-2 ml-auto mr-auto" id="exp-${data.new_id}">
                                    <input class="align-middle" value="${name}" required name="exp-${data.new_id}" id="exp-inp-${data.new_id}" />
                                    <a class="btn btn-outline-primary" onclick="update(${data.new_id})">{{__('messages.update')}}</a>
                                </div>
                        `
                    }else{
                        alert('{{__('messages.could_not_add_expense')}}')
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function update(id){
            let value = $('#exp-inp-'+id)[0].value;
            if(value.length) {
                let url = `{{ action('ExpenseCategoryController@update', 1) }}`;
                url = url.substr(0, url.length - 2) + '/' + id;
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: {_token: CSRF_TOKEN, name: value},
                    success: function (data) {

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        }
        @endif
    </script>
@endsection
