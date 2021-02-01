<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicons/favicon.ico') }}"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix')
        @yield('title','Dashboard')
        @yield('title_postfix')
    </title>
    @yield('meta_tags')

    {{--    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">--}}
    {{--    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">--}}
    {{--    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">--}}
    {{--    <meta name="msapplication-TileColor" content="#ffffff">--}}
    {{--    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">--}}
    {{--    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">--}}

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.17/css/AdminLTE.min.css"
          integrity="sha512-BZispGnPWeExs6W4rWopb7Y9ijJM2u2ozRqhtRGPTxCCERgzLRnz2mDKayCWBvMnaQvSYpX7pROSoV62MYSJ3w=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.17/css/skins/_all-skins.min.css"
          integrity="sha512-KYc8PMaRqUq8Tlh3D1S6YdumJiAdLeGTfvefdm+N4bR+hYzsiVCRgQSD7kqybOXnIs9LkDCVhhzcXHUV+xqpqg=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.1/css/font-awesome.min.css"
          integrity="sha512-H/zVLBHVS8ZRNSR8wrNZrGFpuHDyN6+p6uaADRefLS4yZYRxfF4049g1GhT+gDExFRB5Kf9jeGr8vueDsyBhhA=="
          crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    @stack('styles')
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition login-page" style="height: auto;">
@yield('content')

<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.17/js/adminlte.min.js"
        integrity="sha512-A5qdsR9RXBqwBbUK/UCOc88vYGDcRIT39Y96wvIJk398ZScKAVN3PTv/Br4VBg0hv4kE8HQFmhC4iMFq7mQ8uA=="
        crossorigin="anonymous"></script>
@stack('scripts')

</body>
</html>
