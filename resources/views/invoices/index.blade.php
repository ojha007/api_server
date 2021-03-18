@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    List Invoices from MYOB
@endsection
@section('subHeader')
    List of all invoices
@endsection
@section('breadcrumb')
@stop
@section('content')
    <div class="box">
        <div class="box-header">
            @if($url)
                <h3 class="box-title">
                    <a href="{{$url}}">Click here to link with MYOB Account</a>
                </h3>
            @endif
            @if(isset($accountRights) && !\Storage::disk('local')->exists(config('myob.defaultAccount')))
                <div class="col-md-12">
                    <div class="form-group col-md-6">

                        <div class="col-md-3">
                            <label for="accountRight">Select Company:</label>
                        </div>
                        <div class="col-md-8">
                            <select id="accountRight" class="select2 form-control">
                                <option>-- SELECT --</option>
                                @foreach($accountRights as $key=>$accountRight)
                                    <option value="{{$key}}">
                                        {{$accountRight->Name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            @else
                @if(!$url)
                    <h3 class="box-title">Lists of all invoices (
                        @if(\Storage::disk('local')->exists(config('myob.defaultAccount')))
                            <b>
                                {{json_decode(\Storage::get(config('myob.defaultAccount')))->Name}}
                            </b>
                            )
                        @endif
                    </h3>
                @endif
            @endif
        </div>
        <div class="box-body">
            @isset($invoices)
{{--                @dd($invoices)--}}
                @if($invoices->Items && is_iterable($invoices->Items))
                    <table class="table-bordered table ">
                        <thead>
                        <tr>
                            <th>Number</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>BalanceDueAmount</th>
                            <th>ShipToAddress</th>
                            <th>Subtotal</th>
                            <th>TotalTax</th>
                            <th>TotalAmount</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoices->Items as $item)
                            <tr>
                                <td>
                                    {{$item->Number}}
                                </td>
                                <td>
                                    {{\Carbon\Carbon::parse($item->Date)->format('Y-m-d')}}
                                </td>
                                <td>
                                    {{$item->Customer->Name}}
                                </td>
                                <td>
                                    {{$item->BalanceDueAmount}}
                                </td>
                                <td>
                                    {{$item->ShipToAddress}}
                                </td>
                                <td>
                                    {{$item->Subtotal}}
                                </td>
                                <td>
                                    {{$item->TotalTax}}
                                </td>
                                <td>
                                    {{$item->TotalAmount}}
                                </td>
                                <td>
                                    {{$item->Status}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            @endisset

        </div>
    </div>
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
