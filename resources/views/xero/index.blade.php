@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    List Invoices from XERO
@endsection
@section('subHeader')
    List of all invoices
@endsection
@section('breadcrumb')
@stop
@section('content')
    <div class="box-header d-flex">
        @if($error)
            <p>{{ $error }}</p>
            <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4 pull-right">
                <i class="fa fa-refresh"></i>
                Reconnect to Xero
            </a>
        @elseif($connected)
            <a href="{{ route('xero.auth.logout') }}" class="btn btn-primary btn-large mt-4 pull-right">
                <i class="fa fa-sign-out"></i> Logout To Xero
            </a>
        @else
            <a href="{{route('xero.auth.authorize')}}" class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-sign-in"></i> Login To Xero
            </a>
        @endif
    </div>
    @if($connected)
        <div class="box-header">
            <h3 class="box-title">{{ $organisationName }} via {{ $username }}</h3>
        </div>
    @endif
    <xero-invoice logged="{{$connected}}"></xero-invoice>
@endsection
