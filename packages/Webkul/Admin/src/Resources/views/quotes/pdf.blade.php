<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Cache-control" content="no-cache">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <style type="text/css">
            * {
                font-family: DejaVu Sans;
            }

            body, th, td, h5 {
                font-size: 12px;
                color: #000;
            }

            .container {
                padding: 20px;
                display: block;
            }

            .quote-summary {
                margin-bottom: 20px;
            }

            .table {
                margin-top: 20px;
            }

            .table table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            .table thead th {
                font-weight: 700;
                border-top: solid 1px #d3d3d3;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                padding: 5px 10px;
                background: #F4F4F4;
            }

            .table thead th:last-child {
                border-right: solid 1px #d3d3d3;
            }

            .table tbody td {
                padding: 5px 10px;
                border-bottom: solid 1px #d3d3d3;
                border-left: solid 1px #d3d3d3;
                color: #3A3A3A;
                vertical-align: middle;
            }

            .table tbody td p {
                margin: 0;
            }

            .table tbody td:last-child {
                border-right: solid 1px #d3d3d3;
            }

           .sale-summary {
                margin-top: 40px;
                float: right;
            }

            .sale-summary tr td {
                padding: 3px 5px;
            }

            .sale-summary tr.bold {
                font-weight: 600;
            }

            .label {
                color: #000;
                font-weight: bold;
            }

            .logo {
                height: 70px;
                width: 70px;
            }

            .text-center {
                text-align: center;
            }

            hr {
                color: black;
                width: 200px;
            }
        </style>
    </head>

    <body style="background-image: none; background-color: #fff;">
        <div class="container">

            <div class="header">
                <div class="row">
                    <div class="col-6">
                        <img class="logo" src="{{ asset('/images/cellaax_logo_main.png') }}" style="width:auto; height:100px;"/>
                    </div>
                    <div class="col-6">
                        <h1 class="text-center">{{ __('admin::app.quotes.quote') }}</h1>
                    </div>
                </div>
            </div>

            <div class="quote-summary">
                <div class="row">
                    <span class="label">{{ __('admin::app.quotes.quote-id') }} -</span>
                    <span class="value">#{{ $quote->id }}</span>
                </div>

                <div class="row">
                    <span class="label">{{ __('admin::app.quotes.quote-date') }} -</span>
                    <span class="value">{{ $quote->created_at->format('d-m-Y') }}</span>
                </div>

                <div class="table address">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50%">Vendor</th>

                                @if ($quote->shipping_address)
                                    <th>{{ __('admin::app.quotes.ship-to') }}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                @if (isset($quote->billing_address))
                                    <td>
                                        <p>{{ $quote->person->name ?? '' }}</p>
                                        <p>{{ $quote->billing_address['address'] }}</p>
                                        <p>{{ $quote->billing_address['postcode'] . ' ' .$quote->billing_address['city'] }} </p>
                                        <p>{{ $quote->billing_address['state'] }}</p>
                                        <p>{{ core()->country_name($quote->billing_address['country']) }}</p>
                                    </td>
                                @endif

                                @if (isset($quote->shipping_address))
                                    <td>
                                        <p>{{ $quote->shipping_address['address'] }}</p>
                                        <p>{{ $quote->shipping_address['postcode'] . ' ' .$quote->shipping_address['city'] }} </p>
                                        <p>{{ $quote->shipping_address['state'] }}</p>
                                        <p>{{ core()->country_name($quote->shipping_address['country']) }}</p>
                                    </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table items">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('admin::app.products.item_code') }}</th>

                                <th>{{ __('admin::app.products.item_name') }}</th>

                                <th class="text-center">{{ __('admin::app.quotes.price') }}</th>

                                <th class="text-center">{{ __('admin::app.quotes.quantity') }}</th>

                                <th class="text-center">{{ __('admin::app.quotes.amount') }}</th>

                                {{-- <th class="text-center">{{ __('admin::app.quotes.discount') }}</th> --}}

                                <th class="text-center">{{ __('admin::app.quotes.tax') }}</th>

                                <th class="text-center">{{ __('admin::app.quotes.total') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($quote->items as $item)
                                <tr>
                                    <td>{{ $item->sku }}</td>

                                    <td>
                                        {{ $item->name }}
                                    </td>

                                    <td>RM{{ number_format($item->price, 2) }}</td>

                                    <td class="text-center">{{ $item->quantity }}</td>

                                    <td class="text-center">RM{!! number_format($item->total, 2) !!}</td>

                                    {{-- <td class="text-center">{!! number_format($item->discount_amount, 2) !!}</td> --}}

                                    <td class="text-center">RM{!! number_format($item->tax_amount, 2) !!}</td>
                                    
                                    <td class="text-center">RM{!! number_format($item->total + $item->tax_amount, 2) !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <table class="sale-summary">
                    <tr>
                        <td>{{ __('admin::app.quotes.sub-total') }}</td>
                        <td>-</td>
                        <td>RM{!! number_format($quote->sub_total, 2) !!}</td>
                    </tr>

                    <tr>
                        <td>{{ __('admin::app.quotes.tax') }}</td>
                        <td>-</td>
                        <td>RM{!! number_format($quote->tax_amount, 2) !!}</td>
                    </tr>

                    {{-- <tr>
                        <td>{{ __('admin::app.quotes.discount') }}</td>
                        <td>-</td>
                        <td>{!! core()->formatBasePrice($quote->discount_amount, true) !!}</td>
                    </tr>

                    <tr>
                        <td>{{ __('admin::app.quotes.adjustment') }}</td>
                        <td>-</td>
                        <td>{!! core()->formatBasePrice($quote->adjustment_amount, true) !!}</td>
                    </tr> --}}

                    <tr>
                        <td><strong>{{ __('admin::app.quotes.total') }}</strong></td>
                        <td><strong>-</strong></td>
                        <td><strong>RM{!! number_format($quote->grand_total, 2) !!}</strong></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>

                    <tr>
                        <td><strong>Reviewed By:</strong></td>
                    </tr>

                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <tr >
                        <td></td>
                    </tr>
                    <tr >
                        <td></td>
                    </tr>
                    <tr >
                        <td></td>
                    </tr>

                    <tr>
                        <td><hr></td>
                    </tr>

                    <tr>
                        <td>Name:</td>
                    </tr>

                    <tr>
                        <td>Date:</td>
                    </tr>
                </table>

                <div class="row">
                    <small>Notes and Instructions:</small>
                    <small>
                        <ol type="1">
                            <li>Please mention purchase order number in the invoice.</li>
                            <li>All deliveries to be made to the shipping address mentioned above.</li>
                            <li>Please notify us immediately if you are unable to ship as specified.</li>
                            <li>
                                We reserve the right to reject items or require refund for the items<br>
                                that are not in good order or condition as determined by our quality<br>
                                control. A notification will be given within
                                seven (7) working days<br>
                                after order received.
                            </li>
                            <li>
                                For quality problems that cannot be identified at the time of <br>
                                receipt, if any problem found during use, we may provide a record<br>
                                of the experimental process. If the product is found to be<br>
                                a problem itself, the seller must provide a replacement or<br>
                                refund in time, which must be completed in seven (7) days.
                            </li>
                            <li>
                                Please arrange our order with products of at least or more<br>
                                than half of the assigned shelf life.
                            </li>
                        </ol>
                    </small>
                </div>
            </div>
        </div>
    </body>
</html>
