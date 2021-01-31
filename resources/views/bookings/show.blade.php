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

    <div class="row">
        <div class="col-md-12">
            <div class="box-header">
                <div class="pull-right">
                    @if($booking->is_verifeid === 0)
                        <div class="btn-group pull-right">
                            {!! Form::open(['route'=>['bookings.confirmed',$booking->id]]) !!}
                            <button
                                href="{{route('bookings.show',$booking->id)}}"
                                data-container="body" title="Close"
                                class="btn btn-default btn-flat">
                                <i class="fa fa-check"></i>
                                Confirmed
                            </button>
                            {!! Form::close() !!}
                        </div>
                    @else
                        <label class="label label-success bg-green btn btn-flat">
                            Confirmed
                        </label>
                    @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="box box-default border-0">
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
                    {{--            @dd($booking)--}}
                </div>
            </div>
        </div>
    </div>
@endsection
