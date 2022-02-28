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
        @if($booking->is_verified ==0)
            <div class="btn-group">
                <button type="button" class="btn btn-success btn-flat pull-right ml-2"
                        data-toggle="modal" data-target="#modal-booking-confirm">
                    <i class="fa fa-check"></i> Confirmed
                </button>
            </div>
            <div class="btn-group">
                <a type="button" href="{{route('bookings.edit',$booking->id)}}"
                   class="btn btn-primary  btn-flat pull-right">
                    <i class="fa fa-edit"></i>
                    Edit
                </a>
            </div>
        @else
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-flat pull-right ml-2"
                        data-toggle="modal" data-target="#modal-booking-assigned">
                    <i class="fa fa-user"></i> Assign Worker
                </button>
            </div>
        @endif
    </div>
    {{--    <section class="invoice" style="margin: 1px">--}}
    <!-- title row -->
    <div class="box">
        <div class="box-header with-border">
            <h2>
                <i class="fa fa-user"></i>
                {{$booking->name}} <br>
                <small>
                    Moving Date : {{$booking->moving_date}} <br>
                </small>
                <small>
                    Time : {!! $booking->time ? \Carbon\Carbon::parse($booking->time)->format('g:i A') : ''!!}
                </small>
            </h2>

        </div>
        <div class="box-body">
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{$booking->moving_from_suburb}}</strong><br>
                        {{$booking->pickup_address}}<br>
                        Phone:{{$booking->phone}}<br>
                        Email: {{$booking->email}}
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{$booking->moving_to_suburb}}</strong><br>
                        {{$booking->dropoff_address}}<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Task #{{$booking->task->code ?? ''}}</b>
                    <br>
                    <p>{!! spanByStatus($booking->is_verified) !!}</p>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Addition Address:</th>
                            <td>{{$booking->additional_address}}</td>
                        </tr>
                        <tr>
                            <th>Addition Service:</th>
                            <td>{{$booking->additional_service}}</td>
                        </tr>
                        <tr>
                            <th>Size of Moving:</th>
                            <td>{{$booking->size_of_moving ?? ''}}</td>
                        </tr>
                        <tr>
                            <th>Access Parking:</th>
                            <td>{{$booking->access_parking}}</td>
                        </tr>
                        <tr>
                            <th>Inventory:</th>
                            <td>{{$booking->inventory}}</td>
                        </tr>
                        <tr>
                            <th>Comments:</th>
                            <td>{{$booking->comments}}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{!! $booking->description !!}</td>
                        </tr>
                        <tr>
                            <th>Payment:</th>
                            <td>
                                {{$booking->payment->sum('amount')}}
                                {{$booking->payment->first()->payment_currency ?? ''}}
                            </td>
                        </tr>
                        <tr>
                            <th>Quotes:</th>
                            <td>{{$booking->quotes}}</td>
                        </tr>
                        <tr>
                            <th>Hear about us:</th>
                            <td>{{$booking->hear_about_us}}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <div class="row" style="margin-top: 5rem">
                <div class="col-md-4">
                    Booked By: <strong>{{$booking->user->name}}</strong>
                </div>
                <div class="col-md-4">
                    Booked On : <strong>{{$booking->created_at}}</strong>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    {{--    </section>--}}
    @include('bookings.partials.modal')
    @include('bookings.partials.workers-modal')

@endsection
