@extends('layouts.master')
@section('title_postfix') | Quotation @endsection
@section('header')Quotation @endsection
@section('subHeader') Edit Quotation @endsection
@section('breadcrumb') @endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Quotation</h3>
                </div>
                {!! Form::model($quotation,['route'=>['quotations.update',$quotation->id],'role'=>'from']) !!}
                @method('PATCH')
                <div class="box-body">
                    @include('quotations.partials.form')
                </div>
                {!! Form::formButton() !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
