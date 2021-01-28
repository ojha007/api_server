@extends('layouts.master')
@section('title_postfix') | Tasks @endsection
@section('header')
    Task
@endsection
@section('subHeader')
    Create Task
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::open(['route'=>'tasks.store']) !!}
        @include('tasks.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
