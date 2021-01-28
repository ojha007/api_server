@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    List of all Campaign
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right p-3">
                <a href="{{route('campaigns.create')}}">
                    <i class="fa fa-plus"></i>
                    Create Campaign
                </a>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>From Mail</td>
                    <td>Subject</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($campaigns as $campaign)
                    <tr>
                        <td>{{$campaign->from_email}}</td>
                        <td>{{$campaign->subject}}</td>
                        <td>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <strong>No Campaign is recorded.</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
