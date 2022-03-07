@extends('layouts.master')
@section('title_postfix') | Invoices @endsection
@section('header')
    Show Invoice from XERO
@endsection
@section('subHeader')
    Invoice
@endsection
@section('breadcrumb')
@stop
@section('content')
    <section class="invoice" style="margin: 0">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header" style="margin-top: 0">
                    <i class="fa fa-paperclip"></i> #{{request()->route('invoiceId')}}
                    <small
                        class="pull-right">Status: {!! spanByStatus($invoices->getInvoices()[0]['status']) !!}
                    </small>
                </h2>
            </div>
        </div>
        @if($invoices->getInvoices())
            @foreach($invoices->getInvoices() as $invoice)
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        INVOICE DETAIL
                        <br>
                        <b>No: #{{$invoice['invoice_number']}}</b><br>
                        <b>Amount Type:</b> {{$invoice['line_amount_types']}}<br>
                        <b>Date : </b>{{dateFormat($invoice['date'])}}<br>
                        <b>Type :</b>{{$invoice['type']}}
                    </div>

                    <div class="col-sm-4 invoice-col">
                        CUSTOMER DETAIL
                        <address>
                            <strong>{{$invoice['contact']['name']}}</strong>
                            @for($i =0 ; $i<=count($invoice['contact']['addresses']) -1 ; $i++)
                                @if($invoice['contact']['addresses'][$i]['address_line1'])
                                    <br>
                                    {{$invoice['contact']['addresses'][$i]['address_line1']}}
                                    -
                                    {{$invoice['contact']['addresses'][$i]['address_line2']}}
                                @endif
                            @endfor
                            <br>
                            @for($i =0 ; $i<=count($invoice['contact']['phones']) -1 ; $i++)
                                @if($invoice['contact']['phones'][$i]['phone_number'])
                                    <br>
                                    {{$invoice['contact']['phones'][$i]['phone_number']}}
                                    <br>
                                @endif
                            @endfor
                            {!! $invoice['contact']['email_address'] ? 'Email'.$invoice['contact']['email_address'] .'<br>':''  !!}

                            Status: {!! spanByStatus($invoice['contact']['contact_status'])!!}
                        </address>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <b>Currency:</b> {{$invoice['currency_code']}}<br>
                        <b>Currency Rate:</b> {{$invoice['currency_rate']}}<br>

                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped" style="margin-top: 3rem;margin-bottom: 3rem">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>Account Code</th>
                                <th>Qty</th>
                                <th>Unit Amount</th>
                                <th>Amount</th>
                                <th>Tax Type</th>
                                <th>Tax Amount</th>
                                <th>Discount Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0 ;$i<=count($invoice['line_items']) -1;$i++)
                                <tr>
                                    <td>{{$i +1}}</td>
                                    <td>{{$invoice['line_items'][$i]['description'] ?? '-'}}</td>
                                    <td>
                                        {{$invoice['line_items'][$i]['account_code'] ?? '--'}}
                                    </td>
                                    <td>{{$invoice['line_items'][$i]['quantity'] ?? '-'}}</td>
                                    <td>{{$invoice['line_items'][$i]['unit_amount'] ?? '-'}}</td>
                                    <td>{{$invoice['line_items'][$i]['line_amount'] ?? '-'}}</td>
                                    <td>{{$invoice['line_items'][$i]['tax_type'] ?? '-'}}</td>
                                    <td>{{$invoice['line_items'][$i]['tax_amount'] ?? '-'}}</td>
                                    <td>{{$invoice['line_items'][$i]['discount_amount'] ?? '-'}}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <p class="lead">Payments:</p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                @if(is_array($invoice['payments']))
                                    @for($i=0 ;$i <= count($invoice['payments']) -1;$i++)
                                        <tr>
                                            <th>Payment Id</th>
                                            <td>{{$invoice['payments'][$i]['payment_id']}}</td>
                                        </tr>
                                        <tr>
                                            <th>Type</th>
                                            <td>{{$invoice['payments'][$i]['payment_type']}}</td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr>
                                        <td>PAYMENT DETAIL COULD NOT FOUND.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <p class="lead">Amount <small class="pull-right">
                                @if($invoice['due_date'])
                                    Due Date : {{dateFormat($invoice['due_date'])}}
                                @endif
                                @if($invoice['fully_paid_on_date'])
                                    | Paid Date
                                    : {{dateFormat($invoice['fully_paid_on_date'])}}
                                @endif
                            </small>
                        </p>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width:50%">Subtotal:</th>
                                    <td>{{$invoice['sub_total']}}</td>
                                </tr>
                                <tr>
                                    <th>Tax</th>
                                    <td>{{$invoice['total_tax']}}</td>
                                </tr>
                                <tr>
                                    <th>Cis Deduction:</th>
                                    <td>{{$invoice['cis_deduction']}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{$invoice['total_discount']}}</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td>{{$invoice['total']}}</td>
                                </tr>
                                <tr>
                                    <th>Paid Amount:</th>
                                    <td>{{$invoice['amount_paid']}}</td>
                                </tr>
                                <tr>
                                    <th>Due Amount:</th>
                                    <td>{{$invoice['amount_due']}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row no-print">
                    <div class="col-xs-12">
                        @php($canMail = in_array($invoice['status'],['DRAFT','VOIDED','DELETED']) )
                        <a href="{{ $canMail  ? 'javascript:void(0)' :route('xero.invoice.email',[$invoice['invoice_id'],'status'=>$invoice['status']])}}"
                           {{ $canMail? "disabled":"" }}
                           title="{{$canMail ?"Draft,voided or deleted invoices cannot be emailed":''}}"
                           class="btn btn-flat {{ $canMail ? 'btn-danger' : "btn-success"}}">
                            <i class="fa fa-share"></i>
                            Share via Email
                        </a>
                        <a type="button" href="{{route('xero.invoice.payment',$invoice['invoice_id'])}}"
                           class="btn btn-info  btn-flat pull-right"><i
                                class="fa fa-credit-card"></i>
                            Submit Payment
                        </a>
                        <a type="button" class="btn btn-primary btn-flat   pull-right"
                           href="{{route('xero.invoice.pdf',$invoice['invoice_id'])}}"
                           style="margin-right: 5px;">
                            <i class="fa fa-download"></i> Generate PDF
                        </a>
                    </div>
                </div>
            @endforeach
        @endif
    </section>
@endsection
