@extends('layouts.master')
@section('title_postfix') | Enquiry @endsection
@section('header')
    Enquiries
@endsection
@section('subHeader')
    List of all enquiries
@endsection
{{--@section('sidebar_type')--}}
{{--    sidebar-collapse--}}
{{--@endsection--}}
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Contact</td>
                    <td>Address</td>
                    <td>Pickup Date/Time</td>
                    <td>Quotation</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>{{$enquiry->name}}</td>
                        <td>{{$enquiry->email}} -- {{$enquiry->mobile_number}}</td>
                        <td>{{$enquiry->address1}} -- {{$enquiry->city}}</td>
                        <td>{{$enquiry->pickup_date}}</td>
                        <td>{{$enquiry->quotation->title ?? ''}}</td>
                        <td>
                            <a class="btn btn-success btn-flat btn-xs"
                               href="{{route('enquiries.show',$enquiry->id)}}"
                               title="Show Enquiry">
                                <i class="fa fa-eye"></i>

                            </a>
{{--                            <a class="btn btn-default btn-flat btn-sm"--}}
{{--                               href="{{route('enquiries.show-quotations',$enquiry->id)}}"--}}
{{--                               title="Send Quotations">--}}
{{--                                <i class="fa fa-mail-reply"></i>--}}

{{--                            </a>--}}
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
