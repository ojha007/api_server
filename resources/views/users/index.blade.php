@extends('layouts.master')
@section('header')
    List Users
@endsection

@section('subHeader')
    Show the list of all users
@endsection
@section('breadcrumb')
@stop
@section('content')
    @can('user-create')
        <div class="box-header">
            <a href="{{route('users.create')}}" class="btn btn-primary btn-flat pull-right">
                <i class="fa fa-plus"></i> Add User
            </a>
        </div>
    @endcan
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-condensed ">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Status</th>
                    <th class="no-sort action-col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            @foreach($user['roles'] as $role)
                                <span class="label btn btn-flat label-success">{{ $role }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if ($user['status'] == 1)
                                <span class="label btn btn-flat label-primary">Active</span>
                            @else
                                <span class="label btn btn-flat label-danger">Inactive</span>
                            @endif
                        </td>
                        <td>

                            @can('user-edit')
                                <a href="{{route('users.edit',$user['id'])}}"
                                   class="btn btn-primary btn-flat edit-button btn-sm">
                                    <i class="fa fa-edit "></i></a>
                            @endcan
                            @if( $user['id'] != \Illuminate\Support\Facades\Auth::id())
                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user['id']], 'style'=>'display:inline', 'onsubmit' => "return confirm('Are you sure you want to delete?')"]) !!}
                                {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger btn-sm btn-flat', 'role' => 'button', 'type' => 'submit',"data-container"=>"body", "data-tooltip"=>"tooltip",
                                            "title"=>"Delete", "data-placement"=>"bottom"]) }}
                                {!! Form::close() !!}

                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- /.col -->
@endsection

