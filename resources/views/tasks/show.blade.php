@extends('layouts.master')
@section('title_postfix') | Task @endsection
@section('header') Task @endsection
@section('subHeader') View Show @endsection
@section('breadcrumb') @endsection
@section('content')
    <section class="invoice" style="margin: 5px">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-tasks"></i>
                    <b> {{$task->code}}</b> {{$task->title}}
                    <small class="pull-right">{{$task->created_at->format('Y-m-d')}}</small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            @if($task->booking)
                <div class="col-sm-6 invoice-col">
                    Booking Details:
                    <address>
                        <strong>{{$task->booking->name}}</strong>
                        <br>
                        Code: <a href="{{route('bookings.show',$task->booking->id)}}"
                                 title="view additional booking information">
                            #BK0{{$task->booking->id}}
                        </a><br>
                        Form: {{$task->booking->moving_from_suburb}}<br>
                        To: {{$task->booking->moving_to_suburb}}<br>
                        Date:{{$task->booking->moving_date}}<br>
                        Phone: {{$task->booking->phone}}<br>
                        Email: {{$task->booking->email}}
                    </address>
                </div>
            @endif
            <div class="col-sm-6 invoice-col">
                <b>Task: #{{$task->code}}</b><br>
                <br>
                <b>Task ID:</b> {{$task->id}}<br>
                <b>Date: </b>{{$task->created_at->format('Y-m-d')}}<br>
                <b>Status: {!! spanByStatus($task->currentStatus) !!}</b>
            </div>
        </div>
{{--        <div class="col-xs-12">--}}
{{--            <h2 class="page-header">--}}
{{--                <i class="fa fa-user"></i>--}}
{{--                <b>Assigned Worker</b>--}}
{{--            </h2>--}}
{{--        </div>--}}
{{--        <div class="row invoice-info">--}}
{{--            @if($task->workers)--}}
{{--                @forelse($task->workers as $worker)--}}
{{--                    <div class="col-sm-4 invoice-col">--}}
{{--                        Worker Information:--}}
{{--                        <address>--}}
{{--                            <strong>--}}
{{--                                <a href="">{{$worker->name}}</a></strong>--}}
{{--                            <br>--}}
{{--                            Phone: {{$task->phone}}<br>--}}
{{--                            Email: {{$worker->email}}--}}
{{--                        </address>--}}
{{--                    </div>--}}
{{--                @empty--}}
{{--                    <p>No any worker is assigned.</p>--}}
{{--                @endforelse--}}
{{--            @endif--}}
{{--        </div>--}}
        @include('tasks.images',['type'=>'START','title'=>"Before starting"])
        @include('tasks.images',['type'=>'MIDDLE','title'=>'In Between Task'])
        @include('tasks.images',['type'=>'END','title'=>'After Task is completed'])
    </section>
@endsection
