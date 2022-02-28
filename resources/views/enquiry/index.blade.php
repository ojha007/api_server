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
                    <td>Email</td>
                    {{--                    <td>Address</td>--}}
                    {{--                    <td>Pickup Date/Time</td>--}}
                    <td>Phone</td>
                    <td>Title</td>
                    <td>Quotation Send</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>{{$enquiry->name}}</td>
                        <td>{{$enquiry->email}}</td>
                        <td>{{$enquiry->phone}}</td>
                        <td>{{$enquiry->title}}</td>
                        <td>
                            @if($enquiry->quotation_id)
                                <a href="{{route('quotations.show',$enquiry->quotation_id)}}">
                                    {{$enquiry->quotation->title ?? ''}}
                                </a>
                            @else
                                NO QUOTATION SEND
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-default btn-flat "
                               href="{{route('enquiries.show',$enquiry->id)}}"
                               title="Show Enquiry">
                                <i class="fa fa-eye"></i>

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
