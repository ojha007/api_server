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
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @forelse($bookings as $booking)
{{--                    <tr>--}}
{{--                        <td>{{$campaign->from_email}}</td>--}}
{{--                        <td>{!! $campaign->subject !!}</td>--}}
{{--                        <td>{{$campaign->schedule}}</td>--}}
{{--                        <td>--}}
{{--                            {!! Form::open(['route'=>['campaigns.destroy',$campaign->id],'class'=>'form-horizontal']) !!}--}}
{{--                            @can('campaign-view')--}}
{{--                                <a class="btn btn-default btn-flat"--}}
{{--                                   href="{{route('tasks.show',$campaign->id)}}">--}}
{{--                                    <i class="fa fa-eye"></i>--}}
{{--                                </a>--}}
{{--                            @endcan--}}
{{--                            @can('campaign-edit')--}}
{{--                                <a class="btn btn-primary btn-flat"--}}
{{--                                   href="{{route('tasks.edit',$campaign->id)}}">--}}
{{--                                    <i class="fa fa-edit"></i>--}}
{{--                                </a>--}}
{{--                            @endcan--}}
{{--                            @can('campaign-delete')--}}
{{--                                @method('DELETE')--}}
{{--                                <button type="submit"--}}
{{--                                        class="btn btn-flat btn-danger"--}}
{{--                                        onclick="return confirm('Are you sure to delete')">--}}
{{--                                    <i class="fa fa-times"></i>--}}
{{--                                </button>--}}
{{--                            @endcan--}}
{{--                            {!! Form::open() !!}--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <strong>No Booking is recorded.</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
