@extends('errors::minimal')

@section('title', __('messages.err_msg_403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'messages.err_msg_403'))
