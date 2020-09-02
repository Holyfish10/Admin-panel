<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kwitantie</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .right {
            text-align: right;
        }

        .ml-3 {
            margin-left: 2em;
        }
    </style>
</head>

<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="4">
                <table>
                    <tr>
                        <td>
                            {{ $invoice->client->company }}<br>
                            {{ $invoice->client->name ?? $invoice->name }}<br>
                            {{ $invoice->street }}, {{ $invoice->zipcode }}<br>
                            {{ $invoice->city }}
                        </td>
                        <td class="right">
                            JdeBCode<br>
                            Jesse de Boer<br>
                            info@jdebcode.nl
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
{{--                            Factuur: 2020-{{ $invoice->id }}<br>--}}
                            Factuur datum: {{ $invoice->created_at->format('d-m-Y') }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td>
                Product
            </td>
            <td>
                Omschrijving
            </td>
            <td>
                Aantal
            </td>
            <td>
                Totaal
            </td>
        </tr>

        <?php
        $item = unserialize($invoice->item);
        $description = unserialize($invoice->description);
        $amount = unserialize($invoice->amount);
        $totalPrice = $invoice->total;

        $price = $invoice->user->wage;
        $total = 0;
        ?>

        @foreach($item as $key => $val)

            <?php
            if($totalPrice == NULL) {
                $total += ($price * $amount[$key]);
                $vat = $total / 100 * ($invoice->user->vat);
            } else {
                $total = $totalPrice;
                $vat = $total / 100 * ($invoice->user->vat);
            }
            ?>

            <tr class="item">
                <td>
                    {{ $val }}
                </td>
                <td>
                    {{ $description[$key] }}
                </td>
                <td>
                    {{ $amount[$key] }}
                </td>
                <td>
                    @if($totalPrice == NULL)
                        € {{ number_format($price * $amount[$key], 2, '.', '') }}
                    @else
                        € {{ number_format($total, 2, '.', '') }}
                    @endif
                </td>
            </tr>

        @endforeach

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                Excl BTW: <span class="ml-2">€ {{ number_format($total, 2, '.', '') }} </span>
            </td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                BTW: <span class="ml-2">€ {{$vat}}</span>
            </td>
        </tr>

        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                Totaal: <span class="ml-2">€ {{ number_format($total + $vat, 2, '.', '') }} </span>
            </td>
        </tr>
    </table>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
            <p class="col-md-12" style="text-align: center!important;"></p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
