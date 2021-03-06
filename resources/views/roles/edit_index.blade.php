@extends('layouts.master')

@section('header')
    <i class="fa fa-fw fa-key"></i> Edit Role
@endsection

@section('subHeader')
    Edit role
@endsection
@section('breadcrumb')
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            {!! Form::open(array('route' => ['roles.update', $role->id], 'method' => 'PATCH','class'=>'form-horizontal')) !!}
            <div class="box">
                <div class="box-body">
                    <div class="form-group {{ $errors->has('name') ? 'has-error':'' }}">
                        {{ Form::label('name', 'Name:', ['class'=>'col-sm-2 control-label'])}}
                        <div class="col-sm-4">
                            {!! Form::text('name', $role->name , array('placeholder' => 'Name','class' => 'form-control', 'autofocus')) !!}
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    @yield('roles-edit')
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat  pull-right">Submit</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-default btn-flat">Cancel</a>
                </div>
            </div>
        {!! Form::close() !!}
        <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

