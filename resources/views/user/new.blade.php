@extends('layouts.main')
@section('title', 'E-Store - Novo Funcionário')
@section('content')

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-user-plus"></i>Cadastrar Usuário</h2>

    <form action="/usuario" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf

        <label for="name"><i class="fa-solid fa-signature"></i>Nome Completo</label>
        <input placeholder="Ex.: Peter Park" type="text" name="name" required id="name" />

        <label for="email"><i class="fa-regular fa-envelope"></i>E-mail</label>
        <input placeholder="Ex.: peterpark@gmail.com" type="email" name="email" required id="email" />

        <label for="password"><i class="fa-solid fa-key"></i>Senha</label>
        <input type="password" name="password" required id="password" />

        <label for="level"><i class="fa-solid fa-briefcase"></i>Cargo</label>
        <select name="accessLevel" id="level" required>
            <option value="1">Gerente</option>
            <option value="2">CEO</option>
        </select>

        <input type="submit" value="Próxima Etapa" />
    </form>
</section>

@endsection()