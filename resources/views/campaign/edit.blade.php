@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    Edit Campaign
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0 ">
        <div class="box-header"></div>
        {!! Form::model($campaign,['route'=>['campaigns.update',$campaign->id]]) !!}
        @method('PATCH')
        @include('campaign.partials.form')
        {!! Form::formButton('Update') !!}
        {!! Form::close() !!}
    </div>
@endsection
