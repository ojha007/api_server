@extends('layouts.master')
@section('title_postfix') | Enquiry @endsection
@section('header')
    Enquiry
@endsection
@section('subHeader')
    Create enquiry
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::open(['route'=>'enquiries.store']) !!}
        @include('enquiry.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
