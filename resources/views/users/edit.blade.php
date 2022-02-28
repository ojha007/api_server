{{--<div class="modal fade" id="modal-edit">--}}
{{--    <div class="modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span></button>--}}
{{--                <h4 class="modal-title">Edit users</h4>--}}
{{--            </div>--}}
{{--            {!! Form::open(array('method'=>'PATCH','class'=>'form-horizontal bootstrap-modal-form')) !!}--}}
{{--            @include('users.form')--}}
{{--            {!! Form::close() !!}--}}

{{--        </div>--}}
{{--        <!-- /.modal-content -->--}}
{{--    </div>--}}
{{--    <!-- /.modal-dialog -->--}}
{{--</div>--}}


@extends('layouts.master')
@section('title_postfix') | User @endsection
@section('header')
    All Users
@endsection
@section('subHeader')
    Edit Users
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        {!! Form::model($user,['route'=>['users.update',$user->id]]) !!}
        @method('PATCH')
        @include('users.form')
        {!! Form::formButton('Update') !!}
        {!! Form::close() !!}
    </div>

@endsection
