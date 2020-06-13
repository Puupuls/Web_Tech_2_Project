@extends('errors::minimal')

@section('title', __('message.err_msg_403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'message.err_msg_403'))
