@extends('layouts.main')
@section('title', 'E-Store - Atuualizar Dados Cliente')
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
    <form action="/clientes/atualizar/{{ $user[0]['id'] }}" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="id" value="{{ $user[0]['id'] }}">

        <label for="name"><i class="fa-solid fa-signature"></i>Nome Completo</label>
        <input placeholder="Ex.: Peter Park" type="text" value="{{ $user[0]['name'] }}" name="name" id="name" />

        <label for="email"><i class="fa-regular fa-envelope"></i>E-mail</label>
        <input placeholder="Ex.: peterpark@gmail.com" value="{{ $user[0]['email'] }}" type="email" name="email" id="email" />

        <label for="password"><i class="fa-solid fa-key"></i>Senha</label>
        <input type="password" name="password" value="" id="password" />

        <input type="submit" value="Próxima Etapa" />
    </form>
</section>

@endsection()