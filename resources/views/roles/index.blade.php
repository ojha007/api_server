@extends('layouts.master')
@section('title_postfix') | Roles @endsection
@section('header')
    List Roles
@endsection
@section('subHeader')
    List of all roles
@endsection
@section('breadcrumb')
@stop
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="box-title pull-right">
                @can('role-create')
                    <a href="{{ route('roles.create') }}"
                       class="btn btn-primary btn-flat pull-right">
                        Add Role</a>
                @endcan
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-condensed dataTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="no-sort" width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role['name'] }}</td>
                        <td>
                            @can('role-edit')
                                <a class="btn btn-primary btn-flat btn-sm" data-container="body"
                                   title="Edit"
                                   href="{{ route('roles.edit', $role['id']) }}"><i
                                        class="fa fa-edit "></i></a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role['id']],'style'=>'display:inline', 'onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-flat btn-sm', "data-container"=>"body",
                                                 "title"=>"Delete" ,'role' => 'button', 'type' => 'submit']) }}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
