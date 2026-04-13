@extends('layout.errors')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Authentication is required to access this resource. Please log in with valid credentials.'))
