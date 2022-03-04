@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    List Invoices from XERO
@endsection
@section('subHeader')
    List of all invoices
@endsection
@section('breadcrumb')
@stop
@section('content')
    @if($error)
        <h1>Your connection to Xero failed</h1>
        <p>{{ $error }}</p>
        <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
            Reconnect to Xero
        </a>
    @elseif($connected)
        <h1>You are connected to Xero</h1>
        <p>{{ $organisationName }} via {{ $username }}</p>
        <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
            Reconnect to Xero
        </a>
    @else
        <h1>You are not connected to Xero</h1>
        <a href="{{ route('xero.auth.authorize') }}" class="btn btn-primary btn-large mt-4">
            Connect to Xero
        </a>
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#accountRight').on('change', function () {
                if ($(this).val()) {
                    window.location.href = '?selected=' + $(this).val()
                }
            })
        })
    </script>
@endpush
