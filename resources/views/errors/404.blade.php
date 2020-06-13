@extends('errors::minimal')

@section('title', __('messages.err_msg_404'))
@section('code', '404')
@section('message', __($exception->getMessage() ?: 'messages.err_msg_404'))
