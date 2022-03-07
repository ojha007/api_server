@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    Show Invoice from XERO
@endsection
@section('subHeader')
    Invoice
@endsection
@section('breadcrumb')
@stop
@section('content')
    <div class="box box-default">
        <div class="box-header">
            <h3 class="box-title">Make Payment</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <div class="col-md-2">
                        <label class="control-label pull-md-right">Account:</label>
                    </div>
                    <div class="col-md-10">
                        {!! Form::select('account',$accounts,null,['class'=>'form-control select2','placeholder'=>'--------SELECT ACCOUNT------']) !!}
                    </div>
                </div>
                <div class="col-md-6 form-group">
                    <div class="col-md-2">
                        <label class="control-label">Reference:</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="reference" placeholder="ENTER REFERENCE NUMBER"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-flat btn-primary pull-right">
                <i class="fa fa-save"></i> Submit
            </button>
            <button type="button" class="btn btn-flat btn-default pull-left">
                <i class="fa fa-backward"></i> Back
            </button>
        </div>
    </div>
@endsection
