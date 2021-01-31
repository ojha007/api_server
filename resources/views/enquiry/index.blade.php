@extends('layouts.master')
@section('title_postfix') | Enquiry @endsection
@section('header')
    Enquiries
@endsection
@section('subHeader')
    List of all enquiries
@endsection
@section('sidebar_type')
    sidebar-collapse
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>City</td>
                    <td>Pickup Date/Time</td>
                    <td>Comments</td>
                    <td width="10%">Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>{{$enquiry->name}}</td>
                        <td>{{$enquiry->email}}</td>
                        <td>{{$enquiry->mobile_number}}</td>
                        <td>{{$enquiry->address1}}</td>
                        <td>{{$enquiry->city}}</td>
                        <td>{{$enquiry->pickup_date}}</td>
                        <td>{{$enquiry->comment}}</td>
                        <td>
                            <a class="btn btn-success btn-flat btn-sm"
                               href="{{route('enquiries.show',$enquiry->id)}}"
                               title="Show Enquiry">
                                <i class="fa fa-eye"></i>

                            </a>
                            <a class="btn btn-default btn-flat btn-sm"
                               href="{{route('enquiries.show-quotations',$enquiry->id)}}"
                               title="Send Quotations">
                                <i class="fa fa-mail-reply"></i>

                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">
                            <strong>No Enquiries is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            {{$enquiries->links()}}
        </div>
    </div>
@endsection
