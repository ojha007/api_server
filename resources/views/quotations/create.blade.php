@extends('layouts.master')
@section('title_postfix') | Quotations @endsection
@section('header')Quotations @endsection
@section('subHeader') Create Quotations @endsection
@section('breadcrumb') @endsection
@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Quotation</h3>
        </div>

        {!! Form::open(['route'=>'quotations.store']) !!}
        <div class="box-body">
            @include('quotations.partials.form')
        </div>
        {!! Form::formButton() !!}
        {!! Form::close() !!}
    </div>
@endsection
