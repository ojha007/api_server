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
                        <label for="select" class="control-label">Select Quotation :</label>
                    </div>
                    <div class="col-md-6 @error('quotation_id') has-error @enderror">
                        {!! Form::select('quotation_id',$selectQuotations,null,
                                ['class'=>'form-control','placeholder'=>'Select Quotation']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary btn-flat">
                        <i class="fa fa-mail-reply"></i>
                        Mail
                    </button>
                    <button type="button"
                            class="btn btn-primary btn-flat bootstrap-modal-form-open"
                            data-toggle="modal"
                            data-target="#quotation-create"> Create Quotations
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="box box-default border-0">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="timeline-item" style="margin: 10px">
                <i class="fa fa-clock-o"></i> {{$enquiry->date}}
                <br>
                <i class="fa fa-user"></i> {{$enquiry->user->name}}
                <br>
                <i class="fa fa-inbox"></i> {{$enquiry->user->email}}
                <h3 class="timeline-header">
                    <a href="#">
                        {{$enquiry->title}}
                    </a>
                </h3>
                <div class="timeline-body" style="margin: 4px;">
                    {{$enquiry->description}}
                </div>
            </div>
        </div>
    </div>
@endsection
@can('quotation-create')
    @include('quotations.partials.modal')
@endcan
