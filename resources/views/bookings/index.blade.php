@extends('layouts.master')
@section('title_postfix') | Bookings @endsection
@section('header')
    Bookings
@endsection
@section('subHeader')
    List of all Booking
@endsection
{{--@section('sidebar_type')--}}
{{--    sidebar-collapse--}}
{{--@endsection--}}
@section('breadcrumb')
@endsection
@push('styles')
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link type="text/css" rel="stylesheet" href="{{asset('backend/css/dp.css')}}">
@endpush
@section('content')
    <div class="box box-solid collapsed-box ">
        <div class="box-header with-border">
            <h3 class="box-title">Advanced Filter</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool"
                        data-widget="collapse">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-4" style="padding-left: 0">
                <label for="moving_date">Moving Date:</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="moving_date">
                </div>
            </div>
            <div class="col-md-3" style="padding-left: 0">
                {!! Form::label('status','Status:') !!}
                {!! Form::select('is_verified',[
                     '1'=>'Confirmed',
                     '0'=>"Pending"
                    ],null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-flat btn-primary">
               <i class="fa fa-filter"></i> Apply Filter
            </button>
        </div>
    </div>

    @can('booking-create')
        <div class="box-header">
            <a href="{{route('bookings.create')}}" class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-plus"></i> Create Booking
            </a>
        </div>
    @endcan

    <div class="box box-default border-0">

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
                        <td style='white-space: nowrap'>

                            @can('booking-view')
                                <a class="btn btn-default btn-flat btn-sm"
                                   title="View"
                                   href="{{route('bookings.show',$booking->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @if(!$booking->is_verified)
                                @can('booking-edit')
                                    <a class="btn btn-primary btn-flat btn-sm"
                                       title="View"
                                       href="{{route('bookings.edit',$booking->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">
                            <strong>No Booking is recorded.</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
            <div class="pull-right">
                {{$bookings->links("pagination::bootstrap-4")}}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('/backend/js/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/backend/js/dp.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#moving_date').daterangepicker({
                orientation: "top right",
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'YYYY-MM-DD hh:mm A'
                },

            })
        });
    </script>
@endpush
