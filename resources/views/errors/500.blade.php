@extends('layout.errors')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', __('The server encountered an unexpected condition that prevented it from fulfilling the request. Please try again later.'))
