@extends('layouts.app')
@section('content')
    <div style="
            height:80vh;
            align-items: center;
            display: flex;
            justify-content: center;
            position: relative;
        ">
        <div style="
            border-right: 2px solid;
            font-size: 26px;
            padding: 0 15px 0 15px;
            text-align: center;
        ">
            @yield('code')
        </div>

        <div style="
            padding: 10px;
            font-size: 18px;
            text-align: center;
        ">
            @yield('message')
        </div>
    </div>
@endsection
