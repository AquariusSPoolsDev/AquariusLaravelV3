@extends('layout.errors')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('The server is currently unable to handle the request due to temporary overload or maintenance. Please try again in a few moments.'))
