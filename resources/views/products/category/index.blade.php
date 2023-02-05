@extends('layouts.main')
@section('title', 'E-Store - Categorias')
@section('content')

<style>
    .container-category-prod {
        justify-content: flex-start !important;
    }

    .category-box {
        position: relative;
        display: flex;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        margin: 0 30px;
        height: 150px;
        min-width: 150px;
        width: fit-content;
        padding: 30px;
        border-radius: 10px;
        justify-content: center;
        background-color: #fff;
        align-items: center;
        flex-wrap: wrap;
    }

    .category-box p {
        margin: 0;
        font-weight: 500;
        letter-spacing: 1px;
        color: rgba(0, 0, 0, .7);
    }
</style>

<section class="container-products container-category-prod">
    <h2 class="title-section-adm"><i class="fa-solid fa-layer-group"></i>Categorias</h2>
    @if(count($categories) > 0)
    @foreach($categories as $category)
    <a href="../produtos?categoria={{ $category->id }}" class="category-box">
        <p>{{ $category->name }}</p>
    </a>
    @endforeach
    @else
    <a href="../produtos" class="category">
        <div class="no-result-container">
            <p>Nenhuma categoria encontrada</p>
            <img id="box-icon" src="/img/stack.png" alt="Ícone caixa vazia" style="margin: 10px 0;" />
        </div>
    </a>
    @endif
</section>

@endsection()