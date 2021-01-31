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
    <div class="box-header">
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right">
            <a href="{{route('bookings.show',$booking->id)}}" class="btn btn-flat btn-default">
                Confirmed
            </a>
        </div>
    </div>
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
@endsection
