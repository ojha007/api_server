@extends('layouts.master')
@section('title_postfix') | Workers @endsection
@section('header')
    Workers
@endsection
@section('subHeader')
    List of all Worker
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <a href="{{route('workers.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Worker
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                {{--                @forelse($enquiries as $enquiry)--}}
                {{--                    <tr>--}}
                {{--                        <td>{{$enquiry->user->name}}</td>--}}
                {{--                        <td>{{$enquiry->user->email}}</td>--}}
                {{--                        <td>{{$enquiry->pickup_detail}}</td>--}}
                {{--                        <td>{{$enquiry->delivery_detail}}</td>--}}
                {{--                        <td>{{$enquiry->date}}</td>--}}
                {{--                        <td>--}}
                {{--                            <a class="btn btn-success btn-flat btn-sm"--}}
                {{--                               href="{{route('enquiries.quotations',$enquiry->id)}}"--}}
                {{--                               title="Send Quotations">--}}
                {{--                                <i class="fa fa-file-text"></i>--}}
                {{--                            </a>--}}
                {{--                        </td>--}}
                {{--                    </tr>--}}
                {{--                @empty--}}
                {{--                    <tr>--}}
                {{--                        <td colspan="4" class="text-center">--}}
                {{--                            <strong>No Enquiries is recorded .</strong>--}}
                {{--                        </td>--}}
                {{--                    </tr>--}}
                {{--                @endforelse--}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
