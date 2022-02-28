@extends('layouts.master')
@section('title_postfix') | Users @endsection
@section('header')
    Users
@endsection
@section('subHeader')
    Create User
@endsection
@section('breadcrumb') @endsection
@section('content')
    {{--    <div class="col-md-9">--}}
    <div class="box box-default ">
        {!! Form::open(['route'=>'users.store']) !!}
        @include('users.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
    {{--    </div>--}}

@endsection
