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
        @component('dashboard.countWidget',['bg'=>'green','title'=>'Completed Task','count'=>100,'icon'=>'check-square-o'])@endcomponent
        @component('dashboard.countWidget',['bg'=>'yellow','title'=>'Total Worker','count'=>10,'icon'=>'users'])@endcomponent
    </div>
@endsection
