@extends('layouts.master')
@section('title_postfix') | FAQ @endsection
@section('header')
    Frequently Asked Questions
@endsection
@section('subHeader')
    List of all faq
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box-header"><h3 class="box-title"></h3>
        <div class="box-tools pull-right p-3">
            <a href="{{route('faqs.create')}}">
                <i class="fa fa-plus"></i>
                Add FAQS
            </a>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{$faq->title}}</td>
                        <td>{{$faq->description}}</td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <strong>No Faqs is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
