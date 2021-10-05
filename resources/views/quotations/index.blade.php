@extends('layouts.master')
@section('title_postfix') | Quotations @endsection
@section('header')Quotations @endsection
@section('subHeader') List of Quotations @endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <div class="box-tools pull-right">
                <a href="{{route('quotations.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Quotations
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <td>Title</td>
                    <td> Action</td>
                </tr>
                </thead>
                <tbody>
                @forelse($quotations as $quotation)
                    <tr>
                        <td>{{$quotation->title}}</td>
                        <td>
                            {!! Form::open(['route'=>['quotations.destroy',$quotation->id]]) !!}
                            @isset($enquiry_id)
                                <a class="btn btn-flat btn-primary btn-sm" title="Send Quotation">
                                    <i class="fa fa-send-o"></i>
                                </a>
                            @endisset
                            @can('quotation-view')
                                <a class="btn btn-flat btn-default btn-sm"
                                   href="{{route('quotations.show',$quotation->id)}}"
                                   title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('quotation-edit')
                                <a class="btn btn-flat btn-primary btn-sm"
                                   href="{{route('quotations.edit',$quotation->id)}}"
                                   title="View">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('quotation-delete')
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are You sure to delete')"
                                        class="btn btn-flat btn-danger btn-sm"
                                        title="Edit">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endcan

                            {!! Form::close() !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <strong>No Quotations is recorded.</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
