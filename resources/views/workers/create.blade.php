@extends('layouts.master')
@section('title_postfix') | Workers @endsection
@section('header')
    Workers
@endsection
@section('subHeader')
    Create Worker
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::open(['route'=>'workers.store']) !!}
        @include('workers.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>

@endsection
