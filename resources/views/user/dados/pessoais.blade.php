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
    <form action="/cliente/dadospessoais" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h3><i class="fa-solid fa-person-circle-check"></i>Dados pessoais</h3>

        <label for="title"><i class="fa-solid fa-signature"></i>Nome</label>
        <input value="{{ $dadosCliente[0]['name'] }}" placeholder="Ex.: Peter" minlength="5" maxlength="50" type="text" name="name" id="title" required />

        <label for="title"><i class="fa-solid fa-signature"></i>Sobrenome</label>
        <input value="{{ $dadosCliente[0]['lastname'] }}" placeholder="Ex.: Parker" minlength="5" maxlength="50" type="text" name="lastname" id="title" required />

        <label for="title"><i class="fa-solid fa-id-card"></i>CPF</label>
        <input value="{{ $dadosCliente[0]['cpf'] }}" placeholder="Ex.: Parker" minlength="11" maxlength="11" type="text" name="cpf" id="title" required />

        <label for="title"><i class="fa-solid fa-cake-candles"></i>Data de Nascimento</label>
        <input value="{{ $dadosCliente[0]['birthdate'] }}" placeholder="Ex.: 14/10/1990" type="date" name="birthdate" id="title" required />

        <h5>Endereço para cobrança</h5>

        <label for="title"><i class="fa-solid fa-map-location-dot"></i>CEP</label>
        <input value="{{ $dadosCliente[0]['cep'] }}" placeholder="Ex.: 12345-678" minlength="8" maxlength="8" type="text" name="cep" id="title" required />

        <label for="title"><i class="fa-solid fa-location-dot"></i>Rua/Avenida</label>
        <input value="{{ $dadosCliente[0]['street'] }}" placeholder="Ex.: Avenida Paulista" minlength="5" maxlength="50" type="text" name="street" id="title" required />

        <label for="title"><i class="fa-solid fa-house"></i>Número</label>
        <input value="{{ $dadosCliente[0]['number'] }}" placeholder="Ex.: 1234" minlength="5" maxlength="50" type="int" name="number" id="title" required />

        <label for="title"><i class="fa-solid fa-location-crosshairs"></i>Referência</label>
        <input value="{{ $dadosCliente[0]['reference'] }}" placeholder="Ex.: Próximo ao MASP" minlength="5" maxlength="50" type="text" name="reference" id="title" />

        <h5>Contato</h5>

        <label for="title"><i class="fa-solid fa-mobile"></i>Celular 01</label>
        <input value="{{ $dadosCliente[0]['contact1'] }}" placeholder="Ex.: (11) 1234-5678" minlength="12" maxlength="12" type="text" name="contact1" id="title" required />

        <label for="title"><i class="fa-solid fa-mobile"></i>Celular 02</label>
        <input value="{{ $dadosCliente[0]['contact2'] }}" placeholder="Ex.: (11) 1234-5678" minlength="12" maxlength="12" type="text" name="contact2" id="title" />

        <label id="label-img" for="img" style="margin: 20px auto 40px auto;">
            <p><i style="margin-right: 5px;" class="fa-solid fa-camera"></i>Escolha sua foto de perfil</p>
            <span id="select-image">
                <i class="fa-solid fa-file-import"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa-solid fa-image"></i>
            </span>
        </label>
        <input value="{{ $dadosCliente[0]['picture'] }}" type="file" name="picture" id="img" onchange="previewFile()" />

        <input type="submit" value="Salvar" />
    </form>

    @else

    <form action="/cliente/dadospessoais" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf

        <h3><i class="fa-solid fa-person-circle-check"></i>Dados pessoais</h3>

        <label for="title"><i class="fa-solid fa-signature"></i>Nome</label>
        <input placeholder="Ex.: Peter" minlength="5" maxlength="50" type="text" name="name" id="title" required />

        <label for="title"><i class="fa-solid fa-signature"></i>Sobrenome</label>
        <input placeholder="Ex.: Parker" minlength="5" maxlength="50" type="text" name="lastname" id="title" required />

        <label for="title"><i class="fa-solid fa-id-card"></i>CPF</label>
        <input placeholder="Ex.: Parker" minlength="11" maxlength="11" type="text" name="cpf" id="title" required />

        <label for="title"><i class="fa-solid fa-cake-candles"></i>Data de Nascimento</label>
        <input placeholder="Ex.: 14/10/1990" type="date" name="birthdate" id="title" required />

        <h5>Endereço para cobrança</h5>

        <label for="title"><i class="fa-solid fa-map-location-dot"></i>CEP</label>
        <input placeholder="Ex.: 12345-678" minlength="8" maxlength="8" type="text" name="cep" id="title" required />

        <label for="title"><i class="fa-solid fa-location-dot"></i>Rua/Avenida</label>
        <input placeholder="Ex.: Avenida Paulista" minlength="5" maxlength="50" type="text" name="street" id="title" required />

        <label for="title"><i class="fa-solid fa-house"></i>Número</label>
        <input placeholder="Ex.: 1234" minlength="5" maxlength="50" type="int" name="number" id="title" required />

        <label for="title"><i class="fa-solid fa-location-crosshairs"></i>Referência</label>
        <input placeholder="Ex.: Próximo ao MASP" minlength="5" maxlength="50" type="text" name="reference" id="title" />

        <h5>Contato</h5>

        <label for="title"><i class="fa-solid fa-mobile"></i>Celular 01</label>
        <input placeholder="Ex.: (11) 1234-5678" minlength="12" maxlength="12" type="text" name="contact1" id="title" required />

        <label for="title"><i class="fa-solid fa-mobile"></i>Celular 02</label>
        <input placeholder="Ex.: (11) 1234-5678" minlength="12" maxlength="12" type="text" name="contact2" id="title" />

        <label id="label-img" for="img" style="margin: 20px auto 40px auto;">
            <p><i style="margin-right: 5px;" class="fa-solid fa-camera"></i>Escolha sua foto de perfil</p>
            <span id="select-image">
                <i class="fa-solid fa-file-import"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa-solid fa-image"></i>
            </span>
        </label>
        <input type="file" name="picture" id="img" onchange="previewFile()" />

        <input type="submit" value="Salvar"/>
    </form>

    @endif
</section>

@endsection()