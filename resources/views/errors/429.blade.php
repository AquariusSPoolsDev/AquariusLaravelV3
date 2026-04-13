@extends('layout.errors')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('You have sent too many requests in a short period. Please wait before making further requests.'))
