@extends('layouts.master')
@section('title_postfix') | Workers @endsection
@section('header')
    Workers
@endsection
@section('subHeader')
    List of all Worker
@endsection
@section('breadcrumb') @endsection
@section('content')
    @can('worker-create')
    <div class="box-header">
        <a href="{{route('workers.create')}}" class="btn btn-primary btn-flat pull-right">
            <i class="fa fa-plus"></i> Add Worker
        </a>
    </div>
    @endcan
    <div class="box box-default border-0">
        <div class="box-body">
            <table class="table table-bordered table-responsive">
                <thead>
                <tr>
                    <td>S.No</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Status</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                @forelse($workers as $worker)

                    <tr>
                        <td><strong>#{{$worker->id}}</strong></td>
                        <td>{{$worker->name}}</td>
                        <td>{{$worker->email}}</td>
                        <td>{{$worker->phone}}</td>
                        <td>{!! spanByStatus($worker->status)!!}</td>
                        <td>
                            {!! Form::open(['route'=>['workers.destroy',$worker->id],'class'=>'form-horizontal']) !!}
                            @method('DELETE')
                            @can('worker-view')
                                <a class="btn btn-default btn-flat"
                                   href="{{route('workers.show',$worker->id)}}" title="View">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('worker-edit')
                                <a class="btn btn-primary btn-flat "
                                   href="{{route('workers.edit',$worker->id)}}"
                                   title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('worker-delete')
                                <button type="submit"
                                        onclick="return confirm('Are you sure to delete ?')"
                                        class="btn btn-danger btn-flat">
                                    <i class="fa fa-times"></i>
                                </button>
                            @endcan
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <strong>No Worker is recorded .</strong>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
