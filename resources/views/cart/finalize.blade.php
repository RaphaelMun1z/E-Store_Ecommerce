@extends('layouts.main')
@section('title', 'E-Store - Finalizar compra')
@section('content')

<style>
    .container-userarea {
        justify-content: flex-start;
    }

    .card-userarea {
        margin: 0 20px 0 0;
    }

    .personal-data {
        position: relative;
        display: flex;
        width: 100%;
        height: 120px;
        border-radius: 10px;
        margin: 20px 0;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        justify-content: space-between;
        align-items: center;
        padding: 20px 50px;
    }

    .personal-data>p {
        margin: 0;
        font-size: 20pt;
        letter-spacing: 1px;
        font-weight: 600;
    }

    .personal-data>a {
        margin: 0;
        font-size: 10pt;
        font-weight: 500;
        color: #fff !important;
    }

    .personal-data>p>i {
        margin-right: 10px;
    }

    .end-cart {
        margin: 40px 0 20px auto;
    }
</style>

<section class="container-products container-userarea" id="new-prod-container">
    <h2 style="margin-bottom: 30px;">Finalizar compra</h2>

    <div class="personal-data">
        @if($hasPersonalData)
        <p style="color: green;"><i class="fa-solid fa-person-circle-check"></i>Dados Pessoais</p>
        <a class="btn btn-primary" href="/cliente/dadospessoais">Visualizar</a>
        @else
        <p style="color: #ffc107;"><i class="fa-solid fa-person-circle-xmark"></i>Dados Pessoais</p>
        <a class="btn btn-warning" href="/cliente/dadospessoais">Editar</a>
        @endif

    </div>

    <div class="personal-data">
        @if($hasDeliveryAdrress)
        <p style="color: green;"><i class="fa-solid fa-truck-plane"></i>Dados de Entrega</p>
        <a class="btn btn-primary" href="/cliente/dadosentrega">Visualizar</a>
        @else
        <p style="color: #ffc107;"><i class="fa-solid fa-triangle-exclamation"></i>Dados de Entrega</p>
        <a class="btn btn-warning" href="/cliente/dadosentrega">Editar</a>
        @endif

    </div>

    <form class="end-cart" method="POST" action="/carrinho/finalizar/buy">
        @csrf

        <p style="margin-left: auto;" class="total-cart">Total: <b>R$</b> {{ number_format($total,2,",","."); }}</p>

        @if($hasDeliveryAdrress && $hasPersonalData)
        <button type="submit" class="btn btn-success">Finalizar Compra <i style="margin-left: 5px;" class="fa-solid fa-check"></i></button>
        @else
        <div style="margin-top: 20px;" class="alert alert-warning" role="alert">
            <i style="margin-right: 10px;" class="fa-solid fa-triangle-exclamation"></i>É necessário que todas as informações estejam atualizadas para prosseguirmos.
        </div>
        @endif
    </form>

</section>

@endsection()