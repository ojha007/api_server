@extends('layouts.master')
@section('header')
    Enquiry
@endsection
@section('subHeader')
    View enquiries
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="col-md-12">
                {!! Form::open(['route'=>'enquiries.send-quotations']) !!}
                <div class="form-group">
                    {!! Form::hidden('enquiry_id',$enquiry->id) !!}
                    <div class="col-md-2">
                        <label for="select" class="control-label">Select Quotation:</label>
                    </div>
                    <div class="col-md-6 @error('quotation_id') has-error @enderror">
                        {!! Form::select('quotation_id',$selectQuotations,$enquiry->quotation->id ?? null,
                                ['class'=>'form-control','placeholder'=>'Select Quotation']) !!}
                    </div>
                    @if(empty($enquiry->quotation))
                        <button type="submit" class="btn btn-primary btn-flat">
                            Send
                        </button>
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
    <div class="box box-default border-0">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-borderless  table-striped">
                <tbody>
                <tr>
                    <th>Code</th>
                    <td><strong>#IN{{$enquiry->id}}</strong></td>
                </tr>
                <tr>
                    <th>Pick Up Date</th>
                    <td>{{$enquiry->pickup_date}}</td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td>{{$enquiry->name}}</td>
                </tr>
                <tr>
                    <th>Customer Email</th>
                    <td>{{$enquiry->email}}</td>
                </tr>
                <tr>
                    <th>Enquiry Title</th>
                    <td>{{$enquiry->title}}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{$enquiry->description}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
