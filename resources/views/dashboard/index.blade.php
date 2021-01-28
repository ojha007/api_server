@extends('layouts.master')
@section('title_postfix')
    | Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('subHeader')
    Dashboard
@endsection
@section('breadcrumb')
@endsection
@section('content')
    <div class="row">
        @include('dashboard.countWidget')
    </div>
@endsection
