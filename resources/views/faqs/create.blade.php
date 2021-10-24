@extends('layouts.master')
@section('title_postfix') | FAQ @endsection
@section('header')
    Frequently Asked Questions
@endsection
@section('subHeader')
    Create FAQ
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::open(['route'=>['faqs.store']]) !!}
        @include('faqs.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
