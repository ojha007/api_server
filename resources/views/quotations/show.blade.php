@extends('layouts.master')
@section('title_postfix') | Quotation @endsection
@section('header')Quotation @endsection
@section('subHeader') View Quotation @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box-header">
        <a href="{{route('quotations.edit',$quotation->id)}}" class="btn btn-primary btn-flat pull-right">
            <i class="fa fa-edit"></i> Edit Quotations
        </a>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$quotation->title}}</h3>
        </div>
        <div class="box-body">
            {!!  $quotation->description!!}
        </div>
    </div>
@endsection
