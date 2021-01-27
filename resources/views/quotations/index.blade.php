@extends('layouts.master')
@section('title_postfix') | Quotations @endsection
@section('header')Quotations @endsection
@section('subHeader') Quotations @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title">
            </h3>
            <div class="box-tools pull-right">
                <a href="{{route('quotations.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Quotations
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    {!!  Form::open()!!}
                    <div class="form-group">
                        {{--                        {{Form::lable('A','A')}}--}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
