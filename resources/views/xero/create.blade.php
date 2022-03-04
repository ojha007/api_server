@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    Create Invoice
@endsection
@section('subHeader')
    Invoice
@endsection
@section('breadcrumb')
@stop
@section('content')
    <xero-invoice-create></xero-invoice-create>
@endsection
