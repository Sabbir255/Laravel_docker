@extends('layouts.master')


@section('admin')
<div class="row d-flex justify-content-between align-items-center py-3">

    <h1 class="text-center mt-5">Welcome</h1>
    <h4 class="text-center mt-5 text-primary">{{ auth()->user()->name }}</h4>
                      
@endsection