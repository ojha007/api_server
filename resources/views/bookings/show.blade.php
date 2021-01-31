@extends('layouts.master')
@section('title_postfix') | Bookings @endsection
@section('header')
    Bookings
@endsection
@section('subHeader')
    Booking
@endsection
@section('breadcrumb')
@endsection
@section('content')
    {{--    @if($booking->is_verified == 1)--}}
    {{--        @if($assigned_worker)--}}
    {{--            <div class="box box-solid">--}}
    {{--                <div class="box-header with-border">--}}
    {{--                    <h3 class="box-title">--}}
    {{--                        <i class="fa fa-user"></i>--}}
    {{--                        Assigned Worker Information--}}
    {{--                    </h3>--}}
    {{--                </div>--}}
    {{--                <div class="box-body">--}}
    {{--                    <div class="col-md-2">--}}
    {{--                        <figure>--}}
    {{--                            <img src="{{asset('/backend/images/'.$assigned_worker->avatar)}}"--}}
    {{--                                 height="100px"--}}
    {{--                                 width="auto" alt="Worker Image">--}}
    {{--                        </figure>--}}
    {{--                    </div>--}}
    {{--                   <div class="col-md-4">--}}
    {{--                       <p>Name:{{$assigned_worker->name}}</p>--}}
    {{--                       <p>Email:{{$assigned_worker->email}}</p>--}}
    {{--                       <p>Phone:{{$assigned_worker->phone}}</p>--}}
    {{--                       <p>Assigned on:{{$assigned_worker->assigned_time}}</p>--}}
    {{--                   </div>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        @else--}}
    {{--            <div class="box box-solid">--}}
    {{--                <div class="box-header with-border">--}}
    {{--                    <i class="fa fa-text-width"></i>--}}
    {{--                    <h3 class="box-title">--}}
    {{--                        <label class="label label-success bg-green btn btn-flat" style="margin-right: 10px">--}}
    {{--                            Confirmed--}}
    {{--                        </label>--}}
    {{--                    </h3>--}}
    {{--                </div>--}}
    {{--                <!-- /.box-header -->--}}
    {{--                {!! Form::open(['route'=>'bookings.assigned']) !!}--}}
    {{--                <input type="hidden" name="booking_id" value="{{$booking->id}}">--}}
    {{--                <div class="box-body">--}}
    {{--                    <div class="col-md-4">--}}
    {{--                        <div class="form-group @error('worker_id') has-error @enderror">--}}
    {{--                            {!! Form::select('worker_id',$workers,null,['class'=>'form-control','placeholder'=>'Assign To worker']) !!}--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                    <div class="col-md-4">--}}
    {{--                        <div class="form-group @error('worker_id') has-error @enderror">--}}
    {{--                            <input type="datetime-local" name="assigned_time"--}}
    {{--                                   class="form-control"--}}
    {{--                                   value="{{old('assigned_time')}}">--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="box-footer">--}}
    {{--                    <button class="btn btn-flat btn-primary"--}}
    {{--                            type="submit">--}}
    {{--                        Assign--}}
    {{--                    </button>--}}
    {{--                </div>--}}
    {{--                {!! Form::close() !!}--}}
    {{--            </div>--}}
    {{--        @endif--}}
    {{--    @else--}}
    @if($booking->is_verified ==0)
        <div class="box-header">
            <button type="button" class="btn btn-default btn-flat"
                    data-toggle="modal" data-target="#modal-booking-confirm">
                Confirmed
            </button>
        </div>
    @endif
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title"></h3>
        </div>
        <div class="box-body">
            <div class="col-md-4">
                <p>{{$booking->name}}</p>
                <p>{{$booking->email}}</p>
                <p>{{$booking->phone}}</p>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <p>{{$booking->moving_date}}</p>
            </div>
        </div>
    </div>
    @include('bookings.partials.modal')
@endsection
