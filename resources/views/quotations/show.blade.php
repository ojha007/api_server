@extends('layouts.master')
@section('title_postfix') | Quotation @endsection
@section('header')Quotation @endsection
@section('subHeader') View Quotation @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">{{$quotation->title}}</h3>
            <div class="box-tools pull-right">
                <a class="btn btn-primary btn-sm btn-flat"
                   href="{{route('quotations.edit',$quotation->id)}}">Edit</a>
            </div>
        </div>
        <div class="box-body">
            {!!  $quotation->description!!}
        </div>
    </div>
@endsection
