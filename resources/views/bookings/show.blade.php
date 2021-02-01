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
    @if($booking->is_verified ==0)
        <div class="box-header">
            <button type="button" class="btn btn-primary btn-flat"
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
            @dd($booking)
            <blockquote>
                <p>
                    <i class="fa fa-user"></i>
                    {{$booking->name}}
                </p>
                <p>
                    <i class="fa fa-envelope"></i>
                    {{$booking->email}}
                </p>
                <p>
                    <i class="fa fa-phone"></i>
                    {{$booking->phone}}
                </p>
            </blockquote>
        </div>
    </div>
    </div>
    @include('bookings.partials.modal')
@endsection
