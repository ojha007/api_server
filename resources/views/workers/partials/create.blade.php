@extends('layouts.master')
@section('title_postfix') | Workers @endsection
@section('header')
    Workers
@endsection
@section('subHeader')
    List of all Worker
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-body">
@include('workers.partials.form')
        </div>
    </div>
@endsection
