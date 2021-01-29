@extends('layouts.master')
@section('title_postfix') | Bookings @endsection
@section('header')
    Bookings
@endsection
@section('subHeader')
    List of all Booking
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
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Address</td>
                    <td>Start time</td>
                    <td>End time</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{$booking->title}}</td>
                        <td>{!! $booking->description !!}</td>
                        <td>{{$booking->address}}</td>
                        <td>{{$booking->start_time}}</td>
                        <td>{{$booking->end_time}}</td>
                        <td>
                            {!! Form::open(['route'=>['bookings.destroy',$booking->id],'class'=>'form-horizontal']) !!}
                            @can('booking-view')
                                <a class="btn btn-default btn-flat"
                                   href="{{route('bookings.show',$booking->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('booking-edit')
                                <a class="btn btn-primary btn-flat"
                                   href="{{route('bookings.edit',$booking->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('booking-delete')
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-flat btn-danger"
                                        onclick="return confirm('Are you sure to delete')">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endcan
                            {!! Form::open() !!}
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
        </div>
    </div>
@endsection
