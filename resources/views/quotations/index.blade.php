@extends('layouts.master')
@section('title_postfix') | Quotations @endsection
@section('header')Quotations @endsection
@section('subHeader') List of Quotations @endsection
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
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td> Action</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        @isset($enquiry_id)
                            <a class="btn btn-flat btn-primary" title="Send Quotation">
                                <i class="fa fa-send-o"></i>
                            </a>
                        @endisset
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
