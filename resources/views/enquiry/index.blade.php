@extends('layouts.master')
@section('title_postfix') | Enquiry @endsection
@section('header')
    Enquiries
@endsection
@section('subHeader')
    List of all enquiries
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
                    <td>Title</td>
                    <td>Description</td>
                    <td>Date/Time</td>
                    <td width="10%">Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($enquiries as $enquiry)
                    <tr>
                        <td>{{$enquiry->user->name}}</td>
                        <td>{{$enquiry->user->email}}</td>
                        <td>{{$enquiry->title}}</td>
                        <td>{{$enquiry->description}}</td>
                        <td>{{$enquiry->date}}</td>
                        <td>
                            <a class="btn btn-success btn-flat btn-sm"
                               href="{{route('enquiries.show',$enquiry->id)}}"
                               title="Show Enquiry">
                                <i class="fa fa-eye"></i>

                            </a>
                            <a class="btn btn-default btn-flat btn-sm"
                               href="{{route('enquiries.quotations',$enquiry->id)}}"
                               title="Send Quotations">
                                <i class="fa fa-mail-reply"></i>

                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <strong>No Enquiries is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
