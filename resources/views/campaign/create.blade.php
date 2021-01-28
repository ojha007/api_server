@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    Create Campaign
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0 ">
        {!! Form::open(['route'=>'campaigns.store']) !!}
        @include('campaign.partials.form')
        {!! Form::formButton('Submit') !!}
        {!! Form::close() !!}
    </div>

@endsection
