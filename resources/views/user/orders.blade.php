@extends('layouts.main')
@section('title', 'E-Store - Meus Pedidos')
@section('content')

<style>
    .table {
        margin: 30px !important;
        border-radius: 10px !important;
        overflow: hidden !important;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .table>* {
        border-radius: 10px !important;
        overflow: hidden !important;
    }

    #order-number {
        font-size: 20pt;
        padding: 20px;
    }
</style>

@php
//echo dd($total);
@endphp

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-cart-shopping"></i>Meus Pedidos</h2>

    @if(count($pedidos) > 0)
    @foreach($pedidos as $p)
    <table class="table" style="margin: 20px 0 !important;">
        <thead class="thead-dark">
            <tr>
                <th style="border: none;" id="order-number"># {{ $p->id }}</th>
                <th style="border: none;"></th>
                <th style="border: none;"></th>
            </tr>
            <tr class="line-table-prods">
                <th scope="col">Produto</th>
                <th scope="col">Quantidade Produto</th>
                <th scope="col">Preço</th>
            </tr>
        </thead>
        <tbody>

            @for($ii = 0; $ii < count($p->orderitems); $ii++)
                <tr class="line-table-prods">
                    <td style="padding: 20px 0 !important;"><a style="border-radius: 10px;padding: 10px 20px !important;background: #f05928;color: #fff !important;" href="/produtos/{{ $p->orderitems[$ii]->products->id }}"><i class="fa-solid fa-eye" style="margin-right: 10px;"></i>{{ $p->orderitems[$ii]->products->title }} [#{{ $p->orderitems[$ii]->products->id }}]</a></td>
                    <td>{{ $p->orderitems[$ii]->amount_product }} un.</td>
                    <td>R$ {{ number_format($p->orderitems[$ii]->products->price * $p->orderitems[$ii]->amount_product,2,",","."); }}</td>
                </tr>
                @endfor

                <tr class="line-table-prods">
                    <td></td>
                    <td></td>
                    <td id="order-number"><b>TOTAL:</b> R$ {{ number_format(array_sum($total[$p->id]),2,",","."); }}</td>
                </tr>
        </tbody>
    </table>
    @endforeach
    @else
    <div class="no-result-container" style="margin: 30px auto;">
        <p>Nenhum pedido realizado até o momento</p>
        <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
    </div>
    @endif
</section>

@endsection()