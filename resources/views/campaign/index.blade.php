@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    List of all Campaign
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <a href="{{route('campaigns.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Campaign
                </a>
            </div>
        </div>
    </div>
@endsection
