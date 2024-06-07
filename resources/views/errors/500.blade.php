@extends('errors::minimal')

@section('title', __('Internal Server Error'))
@section('code', '500')

@if($exception->getMessage())
    @section('message', $exception->getMessage())
@else
    @section('message', __('Internal Server Error'))
@endif
