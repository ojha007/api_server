@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    List of all Campaign
@endsection
@section('breadcrumb')
@endsection
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
                    <td>Schedule</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($campaigns as $campaign)
                    <tr>
                        <td>{{$campaign->from_email}}</td>
                        <td>{{$campaign->subject}}</td>
                        <td>{{$campaign->schedule}}</td>
                        <td>
                            {!! Form::open(['route'=>['campaigns.destroy',$campaign->id],'class'=>'form-horizontal']) !!}
                            @can('campaign-view')
                                <a class="btn btn-default btn-flat"
                                   href="{{route('tasks.show',$campaign->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('campaign-edit')
                                <a class="btn btn-primary btn-flat"
                                   href="{{route('tasks.edit',$campaign->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('campaign-delete')
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-flat btn-danger"
                                        onclick="return confirm('Are you sure to delete')">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endcan
                            {!! Form::open() !!}
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
