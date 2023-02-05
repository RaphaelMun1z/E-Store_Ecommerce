@extends('layouts.main')
@section('title', 'E-Store - Área do Usuário')
@section('content')

<section class="container-products container-userarea" id="new-prod-container">
    <h2 class="title-section-adm">Olá, <b style="margin-left: 5px;">{{ Auth::user()->name }} <i class="fa-solid fa-face-grin-beam"></i></b></h2>
    <a href="/cliente/pedidos" class="card-userarea" style="background-color: #95baf7;">
        <div>
            <i class="fa-brands fa-shopify"></i>
            <p>Meus Pedidos</p>
        </div>
    </a>
    <a href="/cliente/dadospessoais" class="card-userarea" style="background-color: #FFA500;">
        <div>
            <i class="fa-solid fa-user-gear"></i>
            <p>Editar Dados Pessoais</p>
        </div>
    </a>
    <a href="/cliente/dadosentrega" class="card-userarea" style="background-color: #FFA500;">
        <div>
            <i class="fa-solid fa-truck-fast"></i>
            <p>Editar Dados de Entrega</p>
        </div>
    </a>
    @if(Auth::user()->accessLevel >= 1)
    <a href="/usuario/adm" class="card-userarea" style="background-color: #FFA500;">
        <div>
            <i class="fa-solid fa-gears"></i>
            <p>Área Administrativa</p>
        </div>
    </a>
    @endif
</section>

@endsection()