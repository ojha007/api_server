@extends('layouts.master')
@section('title_postfix') | Bookings @endsection
@section('header')
    Bookings
@endsection
@section('subHeader')
    List of all Booking
@endsection
@section('sidebar_type')
    sidebar-collapse
@endsection
@section('breadcrumb')
@endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title"></h3>
            @can('booking-create')
                <div class="box-tools pull-right p-3">
                    <a href="{{route('bookings.create')}}">
                        <i class="fa fa-plus"></i>
                        Create Booking
                    </a>
                </div>
            @endcan
        </div>
        <div class="box-body">
            <table class="table table-bordered table-condensed">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Shifting Suburb</td>
                    <td>Shifting Address</td>
                    <td>Moving date</td>
                    <td>Size of moving</td>
                    <td>Status</td>
                    <td>Inventory</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{$booking->name}}</td>
                        <td>{!! $booking->email !!}</td>
                        <td>{!! $booking->phone !!}</td>
                        <td>
                            {{$booking->moving_from_suburb}}
                            <strong>
                                -to-
                            </strong>
                            {{$booking->moving_to_suburb}}
                        </td>
                        <td>
                            {{$booking->pickup_address}}
                            <strong>
                                -to-
                            </strong>
                            {{$booking->dropoff_address}}
                        </td>
                        <td>{{$booking->moving_date}}</td>
                        <td>{{$booking->size_of_moving}}</td>
                        <td>{!! spanByStatus($booking->is_verified) !!}</td>
                        <td>{{$booking->inventory}}</td>
                        <td>
                            @can('booking-view')
                                <a class="btn btn-default btn-flat"
                                   title="View"
                                   href="{{route('bookings.show',$booking->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('booking-confirmed')
                                <a href="{{route('bookings.confirmed',$booking->id)}}"
                                   title="Confirmed"
                                   class="btn btn-flat btn-success">
                                    <i class="fa fa-check"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <strong>No Booking is recorded.</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
            {{$bookings->links()}}
        </div>
    </div>
@endsection
