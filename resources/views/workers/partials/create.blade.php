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
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <a href="{{route('workers.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Worker
                </a>
            </div>
        </div>
        <div class="box-body">

@include('workers.partials.form')
        </div>
    </div>
@endsection
