@extends('layouts.main')
@section('title', 'E-Store - Atualizar Produto')
@section('content')

<section class="container-products" id="new-prod-container">
    <form action="/produtos/atualizar/{{ $product->id }}" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="title"><i class="fa-solid fa-magnifying-glass"></i>Título</label>
        <input value="{{ $product->title }}" placeholder="Ex.: Arduino Uno R3" minlength="5" maxlength="50" type="text" name="title" id="title" required />

        <label for="desc"><i class="fa-solid fa-info"></i>Descrição</label>
        <textarea name="description" id="desc" minlength="20" maxlength="100" cols="30" rows="10" required placeholder="Ex.: É uma placa com microcontrolador Atmega328. Possui 14 entradas/saídas digitais (das quais 6 podem ser usadas como saídas PWM), 6 entradas analógicas, um cristal oscilador de 16MHz, conexão USB, uma entrada para fonte, soquetes para ICSP, e um botão de reset.">{{ $product->description }}</textarea>

        <label for="stk"><i class="fa-solid fa-cubes-stacked"></i>Estoque</label>
        <input value="{{ $product->stock }}" placeholder="Ex.: 58" type="number" min="1" name="stock" required id="stk" />

        <label for="ctg"><i class="fa-solid fa-layer-group"></i>Categoria</label>
        <select name="category" id="ctg" required>
            @if(count($categories) > 0)
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            @else
            <option value="0">Outro</option>
            @endif
        </select>

        <label for="prc"><i class="fa-solid fa-money-bill-wave"></i>Preço (R$)</label>
        <input value="{{ $product->price }}" placeholder="Ex.: 12.99" type="text" min="1" pattern="^\d*(\.\d{0,2})?$" name="price" required id="prc" />

        <label id="label-img" for="img">
            <p>Escolha a imagem ilustrativa</p>
            <span id="select-image">
                <i class="fa-solid fa-file-import"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa-solid fa-image"></i>
            </span>
        </label>
        <input type="file" name="image" id="img" onchange="previewFile()" />

        <section class="container-products base-prev">
            <div class="card">
                <div class="card-top">
                    <img src="/img/products/{{ $product->image }}" alt="Seu produto" class="prev-img" />
                </div>
                <div class="card-bot">
                    <div class="title">
                        <p id="title-card-example">{{ $product->title }}</p>
                    </div>
                    <div class="price-cart">
                        <div class="price">
                            <span>R$</span>
                            <p id="price-card-example">{{ $product->price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <input type="hidden" value="ID" />

        <input type="submit" value="Atualizar Produto"  />
    </form>
</section>

@endsection()