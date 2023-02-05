@extends('layouts.main')
@section('title', 'E-Store - Novo Cliente')
@section('content')

<style>
    h5,
    h3 {
        margin: 0 0 20px 0;
    }

    h5 i,
    h3 i {
        margin-right: 10px;
    }

    h3 {
        color: rgba(0, 0, 0, .6);
        margin-bottom: 40px;
    }

    h5 {
        margin-top: 30px;
    }
</style>

<section class="container-products" id="new-prod-container">
    @if($dadosCliente != null)
    <form action="/cliente/dadosentrega" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3><i class="fa-solid fa-truck-ramp-box"></i>Dados para entrega</h3>

        <label for="title"><i class="fa-solid fa-signature"></i>Nome completo receptor do produto</label>
        <input value="{{ $dadosCliente[0]['name'] }}" placeholder="Ex.: Peter" minlength="5" maxlength="50" type="text" name="name" id="title" required />

        <label for="title"><i class="fa-solid fa-id-card"></i>CPF receptor do produto</label>
        <input value="{{ $dadosCliente[0]['cpf'] }}" placeholder="Ex.: Parker" minlength="5" maxlength="50" type="text" name="cpf" id="title" required />

        <h5>Endereço para entrega</h5>

        <label for="title"><i class="fa-solid fa-map-location-dot"></i>CEP</label>
        <input value="{{ $dadosCliente[0]['cep'] }}" placeholder="Ex.: 12345-678" minlength="5" maxlength="50" type="text" name="cep" id="title" required />

        <label for="title"><i class="fa-solid fa-location-dot"></i>Rua/Avenida</label>
        <input value="{{ $dadosCliente[0]['street'] }}" placeholder="Ex.: Avenida Paulista" minlength="5" maxlength="50" type="text" name="street" id="title" required />

        <label for="title"><i class="fa-solid fa-house"></i>Número</label>
        <input value="{{ $dadosCliente[0]['number'] }}" placeholder="Ex.: 1234" minlength="5" maxlength="50" type="text" name="number" id="title" required />

        <label for="title"><i class="fa-solid fa-location-crosshairs"></i>Referência</label>
        <input value="{{ $dadosCliente[0]['reference'] }}" placeholder="Ex.: Próximo ao MASP" minlength="5" maxlength="50" type="text" name="reference" id="title" required />

        <input type="submit" value="Salvar" />
    </form>
    @else
    <form action="/cliente/dadosentrega" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        <h3><i class="fa-solid fa-truck-ramp-box"></i>Dados para entrega</h3>

        <label for="title"><i class="fa-solid fa-signature"></i>Nome completo receptor do produto</label>
        <input placeholder="Ex.: Peter" minlength="5" maxlength="50" type="text" name="name" id="title" required />

        <label for="title"><i class="fa-solid fa-id-card"></i>CPF receptor do produto</label>
        <input placeholder="Ex.: Parker" minlength="5" maxlength="50" type="text" name="cpf" id="title" required />

        <h5>Endereço para entrega</h5>

        <label for="title"><i class="fa-solid fa-map-location-dot"></i>CEP</label>
        <input placeholder="Ex.: 12345-678" minlength="5" maxlength="50" type="text" name="cep" id="title" required />

        <label for="title"><i class="fa-solid fa-location-dot"></i>Rua/Avenida</label>
        <input placeholder="Ex.: Avenida Paulista" minlength="5" maxlength="50" type="text" name="street" id="title" required />

        <label for="title"><i class="fa-solid fa-house"></i>Número</label>
        <input placeholder="Ex.: 1234" minlength="5" maxlength="50" type="text" name="number" id="title" required />

        <label for="title"><i class="fa-solid fa-location-crosshairs"></i>Referência</label>
        <input placeholder="Ex.: Próximo ao MASP" minlength="5" maxlength="50" type="text" name="reference" id="title" required />

        <input type="submit" value="Salvar" name="ready" />
        @endif
    </form>
</section>

@endsection()