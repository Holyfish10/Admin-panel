@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('invoices') }}">Facturen</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Factuur #{{ $invoice->id }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="invoice-box" style="height: 100vh;">
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
                                Factuur: 2020-{{ $invoice->id }}<br>
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
                        {{ $val ?? '' }}
                    </td>
                    <td>
                        {{ $description[$key] ?? '' }}
                    </td>
                    <td>
                        {{ $amount[$key] ?? '' }}
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
    </div>

</div>
@endsection
