@extends('layouts.main')
@section('title', 'E-Store - Cadastrar Categoria de Produto')
@section('content')

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-layer-group"></i>Cadastrar Categoria</h2>

    <form action="/produtos/categorias" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf

        <label for="category"><i class="fa-solid fa-layer-group"></i>Nome da categoria</label>
        <input placeholder="Ex.: Sensores" minlength="1" maxlength="50" type="text" name="name" id="category" required />

        <input type="submit" value="Criar Categoria" name="ready" />

    </form>
</section>

@endsection()