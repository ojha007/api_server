@extends('layouts.master')
@section('title_postfix') | Developer @endsection
@section('header')
    OAuth Tokens
@endsection

@section('subHeader')
    OAuth Clients and Personal Access Tokens
@endsection
@section('breadcrumb') @endsection
@section('content')
    <div>
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
@endsection
