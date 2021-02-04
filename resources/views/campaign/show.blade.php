@extends('layouts.master')
@section('title_postfix') | Campaign @endsection
@section('header')
    Campaign
@endsection
@section('subHeader')
    Campaign
@endsection
@section('breadcrumb')
@endsection
@section('content')
    <div class="box box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Campaign</h3>
        </div>
        <div class="box-body">
            <div class="col-md-3"></div>
           <div class="col-md-6">
               <table class="table table-bordered table-striped">
                   <tr>
                       <th>From Mail</th>
                       <td>{{$campaign->from_email}}</td>
                   </tr>
                   <tr>
                       <th>Subject</th>
                       <td>{{$campaign->subject}}</td>
                   </tr>
                   <tr>
                       <th>Schedule</th>
                       <td>{{$campaign->schedule}}</td>
                   </tr>
                   <tr>
                       <th>Message</th>
                       <td>{!! $campaign->message !!}</td>
                   </tr>



               </table>
           </div>
        </div>
    </div>
@endsection
