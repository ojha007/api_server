@extends('layouts.master')
@section('title_postfix') | User @endsection
@section('header')
    All Users
@endsection
@section('subHeader')
    Edit Users
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::model($user,['route'=>['users.update',$user->id]]) !!}
        @method('PATCH')
        @include('users.form')
        {!! Form::formButton('Update') !!}
        {!! Form::close() !!}
    </div>

@endsection
