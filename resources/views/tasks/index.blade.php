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
            {{--            <div class="box-tools pull-right">--}}
            {{--                <a href="{{route('tasks.create')}}">--}}
            {{--                    <i class="fa fa-plus"></i>--}}
            {{--                    Add Task--}}
            {{--                </a></div>--}}
        </div>
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>Code</td>
                    <td>Title</td>
                    <Td>Reason</Td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td><b>#{{$task->code}}</b></td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->status()->reason ?? ''}}</td>
                        <td>{!! spanByStatus($task->currentStatus) !!}</td>
                        <td>
                            @can('task-view')
                                <a class="btn btn-default btn-flat btn-sm"
                                   href="{{route('tasks.show',$task->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <strong>No Tasks is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
