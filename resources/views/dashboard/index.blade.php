@extends('layouts.master')
@section('title_postfix')
    | Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('subHeader')
    Dashboard
@endsection
@section('breadcrumb')
@endsection
@section('content')
    <div class="row">
        @component('dashboard.countWidget',['bg'=>'green','title'=>'Today Bookings','count'=>$bookings->count(),'icon'=>'check-square-o'])@endcomponent
        @component('dashboard.countWidget',['bg'=>'default','title'=>'Tasks','count'=>$tasks->count(),'icon'=>'list'])@endcomponent
        @component('dashboard.countWidget',['bg'=>'yellow','title'=>'Total Worker','count'=>$workers->count(),'icon'=>'users'])@endcomponent
        @component('dashboard.countWidget',['bg'=>'primary','title'=>'Today Enquiries','count'=>$enquiries->count(),'icon'=>'question-circle'])@endcomponent
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Today Bookings</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bookings ?? [] as $booking)
                                <tr>
                                    <td>
                                        <a href="{{route('bookings.show',$booking->id)}}">
                                            {{$booking->id}}
                                        </a>
                                    </td>
                                    <td>{{$booking->name}}</td>
                                    <td>{{$booking->email}}</td>
                                    <td>{{$booking->phone}}</td>
                                    <td>{!! spanByStatus($booking->is_verified) !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <strong>
                                            No Booking is recorded today.
                                        </strong>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{route('bookings.index')}}"
                       class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Tasks</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool"
                                data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-bordered">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Title</th>
                                <th>Worker</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks ?? [] as $task)
                                <tr>
                                    <td><strong>{{$task->code}}</strong></td>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->all_workers}}</td>
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <strong>No Tasks is recorded.</strong>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{route('tasks.index')}}"
                       class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- USERS LIST -->
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Workers</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger"></span>
                        <button type="button" class="btn btn-box-tool"
                                data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool"
                                data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <ul class="users-list clearfix" style="margin: 2rem;">
                        @forelse($workers ?? [] as $worker)
                            <li>
                                <img src="{{asset('backend/images/'.$worker->avatar)}}" alt="User Image">
                                <a class="users-list-name" href="#">
                                    {{$worker->name}}
                                </a>
                                <span class="users-list-date">{{$worker->email}}</span>
                                <span class="users-list-date">{{$worker->phone}}</span>
                            </li>
                        @empty
                            <div class="text-center">
                                <strong>No Workers is recorded .</strong>
                            </div>

                        @endforelse
                    </ul>
                    <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    @can('worker-create')
                        <a href="{{route('workers.create')}}"
                           class="btn btn-sm btn-info btn-flat pull-left">
                            Create Worker
                        </a>
                    @endcan
                    @can('worker-view')
                        <a href="{{route('workers.index')}}"
                           class="btn btn-sm btn-default btn-flat pull-right">
                            View All
                        </a>
                    @endcan
                </div>
                <!-- /.box-footer -->
            </div>
            <!--/.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Enquiries</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool"
                                data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($enquiries ?? [] as $enquiry)
                                <tr>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <strong>No Enquiry is recorded.</strong>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="{{route('enquiries.index')}}"
                       class="btn btn-sm btn-default btn-flat pull-right">View All</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
    </div>

@endsection
