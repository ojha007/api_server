@extends('layouts.master')
@section('title_postfix') | Worker @endsection
@section('header')
    Worker
@endsection
@section('subHeader')
    Edit Worker
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::model($worker,['route'=>['workers.update',$worker->id]]) !!}
        @method('PATCH')
        @include('workers.partials.form')
        {!! Form::formButton('Update') !!}
        {!! Form::close() !!}
    </div>

@endsection
