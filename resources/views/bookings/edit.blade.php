@extends('layouts.master')
@section('title_postfix') |  Booking @endsection
@section('header')
     Booking
@endsection
@section('subHeader')
    Edit Booking
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0 ">
        {!! Form::model($booking,['route'=>['bookings.update',$booking->id],'']) !!}
           @method('PATCH')
            @include('bookings.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
