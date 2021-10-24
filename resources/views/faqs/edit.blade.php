@extends('layouts.master')
@section('title_postfix') | FAQ @endsection
@section('header')
    Frequently Asked Questions
@endsection
@section('subHeader')
    Edit FAQ
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::model($faq,['route'=>['faqs.update',$faq->id]]) !!}
        @method('PATCH')
        @include('faqs.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>
@endsection
