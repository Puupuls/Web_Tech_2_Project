@extends('errors::minimal')

@section('title', __('messages.err_msg_503'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'messages.err_msg_503'))
