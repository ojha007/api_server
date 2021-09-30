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
                    <Td>Reason</Td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{$task->code}}</td>
                        <td>{{$task->title}}</td>
                        <td>{{$task->status()->reason ?? ''}}</td>
                        <td>{!! spanByStatus($task->latestStatus) !!}</td>
                        <td>
                            {!! Form::open(['route'=>['tasks.destroy',$task->id],'class'=>'form-horizontal']) !!}
                            @can('task-view')
                                <a class="btn btn-default btn-flat btn-sm"
                                   href="{{route('tasks.show',$task->id)}}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('task-edit')
                                <a class="btn btn-primary btn-flat btn-sm"
                                   href="{{route('tasks.edit',$task->id)}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('task-delete')
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-flat btn-danger btn-sm"
                                        onclick="return confirm('Are you sure to delete')">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endcan
                            {!! Form::open() !!}
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
