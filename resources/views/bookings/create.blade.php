@extends('layouts.master')
@section('title_postfix') | Booking @endsection
@section('header')
    Booking
@endsection
@section('subHeader')
    Create Booking
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0 ">
        <div class="box-header"></div>
        {!! Form::open(['route'=>'bookings.store']) !!}
        @include('bookings.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
