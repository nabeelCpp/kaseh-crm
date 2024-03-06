<html>

<head>
    <meta charset="utf-8">
    <title>Sales Order # {{ $order->order_no }}</title>
    <style>
        /* reset */

        * {
            border: 0;
            box-sizing: content-box;
            color: inherit;
            font-family: inherit;
            font-size: inherit;
            font-style: inherit;
            font-weight: inherit;
            line-height: inherit;
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            vertical-align: top;
        }

        /* heading */

        h1 {
            font: bold 100% sans-serif;
            letter-spacing: 0.5em;
            text-align: center;
            text-transform: uppercase;
        }

        /* table */

        table {
            font-size: 75%;
            table-layout: fixed;
            width: 100%;
        }

        table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        th,
        td {
            border-width: 1px;
            padding: 0.5em;
            position: relative;
            text-align: left;
        }

        th,
        td {
            border-radius: 0.25em;
            border-style: solid;
        }

        th {
            background: #EEE;
            border-color: #BBB;
        }

        td {
            border-color: #DDD;
        }

        /* page */

        html {
            font: 16px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
        }

        html {
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            height: 11in;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
            width: 7.5in;
        }

        body {
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        /* header */

        header {
            margin: 0 0 3em;
        }

        header:after {
            clear: both;
            content: "";
            display: table;
        }

        header h1 {
            background: #000;
            border-radius: 0.25em;
            color: #FFF;
            margin: 0 0 1em;
            padding: 0.5em 0;
        }

        header address {
            float: left;
            font-size: 75%;
            font-style: normal;
            line-height: 1.25;
            margin: 0 1em 1em 0;
        }

        header address p {
            margin: 0 0 0.25em;
        }

        header span,
        header img {
            display: block;
            float: right;
        }

        header span {
            margin: 0 0 1em 1em;
            max-height: 25%;
            max-width: 60%;
            position: relative;
        }

        header img {
            max-height: 100%;
            max-width: 100%;
        }

        header input {
            cursor: pointer;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
            height: 100%;
            left: 0;
            opacity: 0;
            position: absolute;
            top: 0;
            width: 100%;
        }

        /* article */

        article,
        article address,
        table.meta,
        table.inventory {
            margin: 0 0 3em;
        }

        article:after {
            clear: both;
            content: "";
            display: table;
        }

        article h1 {
            clip: rect(0 0 0 0);
            position: absolute;
        }

        article address {
            float: left;
            font-size: 125%;
            font-weight: bold;
        }

        /* table meta & balance */

        table.meta,
        table.balance {
            float: right;
            width: 36%;
        }

        table.meta:after,
        table.balance:after {
            clear: both;
            content: "";
            display: table;
        }

        /* table meta */

        table.meta th {
            width: 40%;
        }

        table.meta td {
            width: 60%;
        }

        /* table items */

        table.inventory {
            clear: both;
            width: 100%;
        }

        table.inventory th {
            font-weight: bold;
            text-align: center;
        }

        table.inventory td:nth-child(1) {
            width: 26%;
        }

        table.inventory td:nth-child(2) {
            width: 38%;
        }

        table.inventory td:nth-child(3) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(4) {
            text-align: right;
            width: 12%;
        }

        table.inventory td:nth-child(5) {
            text-align: right;
            width: 12%;
        }

        /* table balance */

        table.balance th,
        table.balance td {
            width: 50%;
        }

        table.balance td {
            text-align: right;
        }

        /* aside */

        aside h1 {
            border: none;
            border-width: 0 0 1px;
            margin: 0 0 1em;
        }

        aside h1 {
            border-color: #999;
            border-bottom-style: solid;
        }

        /* javascript */

        .add,
        .cut {
            border-width: 1px;
            display: block;
            font-size: .8rem;
            padding: 0.25em 0.5em;
            float: left;
            text-align: center;
            width: 0.6em;
        }

        .add,
        .cut {
            background: #9AF;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
            background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
            border-radius: 0.5em;
            border-color: #0076A3;
            color: #FFF;
            cursor: pointer;
            font-weight: bold;
            text-shadow: 0 -1px 2px rgba(0, 0, 0, 0.333);
        }

        .add {
            margin: -2.5em 0 0;
        }

        .add:hover {
            background: #00ADEE;
        }

        .cut {
            opacity: 0;
            position: absolute;
            top: 0;
            left: -1.5em;
        }

        .cut {
            -webkit-transition: opacity 100ms ease-in;
        }

        tr:hover .cut {
            opacity: 1;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }

            span:empty {
                display: none;
            }

            .add,
            .cut {
                display: none;
            }
        }

        @page {
            margin: 0;
        }
    </style>
</head>

<body>
    <div style="
    display: flex;
    padding: 10px 20px;
    border-bottom: 1px solid black;">
        <p style="flex: 35%;">
            <img src="data:image/png;base64,{{ $base64Image }}" style="max-width: 100px;" sizes="" srcset="" alt="Logo">
        </p>
        <div style="flex: 65%; line-height: 0.5cm">
            <p style="font-weight: bold">73-3, Block G, Zenith Corporate Park</p>
            <p style="font-size: 12px">Jalan SS7 /26, 47301 Kelana Jaya Selangor</p>
            <p style="font-size: 12px">
                M: +60 17- 5343627
            </p>
            <p style="font-size: 12px">
               E: info@kasehcare.com
            </p>
        </div>
    </div>
    <header>
        <h1>Invoice</h1>
        <address>
            <b>BILL TO</b>

            <p>{{ $order->customer->first_name }} {{ $order->customer->last_name ?? null }}</p>
            <p>
                {{ $order->customer->contact_info_address ?? null }} {{ $order->customer->contact_info_city ?? null }}
                {{ $order->customer->contact_info_state ?? null }} {{ $order->customer->contact_info_country ?? null }}
            </p>
            <p>{{ $order->customer->contact_info_phone ?? null }}</p>
        </address>
    </header>
    <article>

        <table class="meta" style="margin-top: -15%">
            <tr>
                <th><span>Invoice #</span></th>
                <td><span>{{ $order->order_no }}</span></td>
            </tr>
            <tr>
                <th><span>Date</span></th>
                <td><span>{{ date('d-M-Y', strtotime($order->created_at)) }} </span></td>
            </tr>
            <tr>
                <th><span>Sales Person</span></th>
                <td><span>{{ $order->user->name ?? null }}</span></td>
            </tr>
            <tr>
                <th><span>Amount Due</span></th>
                <td><span id="prefix">{{ env('CURRENCY') }}</span>
                    <span>{{ number_format($order->total_invoiced, 2) }}</span>
                </td>
            </tr>
        </table>
        <table class="inventory">
            <thead>
                <tr>
                    <th width="50%"><span>Description</span></th>
                    <th><span>Quantity</span></th>
                    <th><span>Unit Price</span></th>
                    <th><span>Tax</span></th>
                    <th><span>Amount MYR</span></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>{{ $product->product->name }}
                            <p>Paymaster: Dato Dr Mahendra Raj </p>
                            <p>Patient Name: {{ $order->customer->first_name }}
                                {{ $order->customer->last_name ?? null }}</p>
                            <p>Check-In: {{ date('d-M-Y', strtotime($order->start_date)) }} @ 9am </p>
                            <p>Check-Out: {{ date('d-M-Y', strtotime($order->end_date)) }} @ 9am</p>
                        </td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ env('CURRENCY') }} {{ number_format($product->unit_price, 2) }}</td>
                        <td>N/A</td>
                        <td><span data-prefix>{{ env('CURRENCY') }} </span>
                            <span>{{ number_format($product->total, 2) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="balance">
            <tr>
                <th><span>Subtotal</span></th>
                <td><span data-prefix>{{ env('CURRENCY') }} </span>
                    <span></span><span>{{ number_format($product->total, 2) }}</span>
                </td>
            </tr>
        </table>
    </article>
    <aside>
        <h1><span>Additional Notes</span></h1>
        <div style="font-size: 12px;">
            <h1>{{$content}}</h1>
        </div>
    </aside>
</body>

</html>
