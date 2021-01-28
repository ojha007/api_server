@extends('layouts.master')
@section('title_postfix') | Task @endsection
@section('header')
    Task
@endsection
@section('subHeader')
    List of all tasks
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div class="box box-default border-0">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <a href="{{route('tasks.create')}}">
                    <i class="fa fa-plus"></i>
                    Add Task
                </a></div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Code</td>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Workers</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{$task->code}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->description}}</td>
                        <td>{{$task->workers->pluck('name')->implode(',')}}</td>
                        <td>{!! spanByStatus($task->status->status) !!}</td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            <strong>No Tasks is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="box-footer">
            <a class="btn btn-sm btn-flat btn-default"
               onclick="window.history.go(-1)">
                Back
            </a>
        </div>
    </div>
@endsection
