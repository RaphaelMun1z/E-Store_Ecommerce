@extends('layouts.main')
@section('title', 'E-Store - Visualizar Produto')
@section('content')

<section class="container-products" id="view-prod-container">
    <div class="img-view">
        @if($product->image != null)
        <img src="/img/products/{{ $product->image }}" alt="Imagem de {{ $product->title }}">
        @else
        <img src="/img/prodImage.png" alt="Imagem de {{ $product->title }}">
        @endif
    </div>
    <div>
        <div>
            <h2>{{ $product->title }}</h2>
            <p>{{ $product->description }}</p>
            <div id="price">
                <p><span>R$</span> {{ number_format($product->price,2,",","."); }}</p>
            </div>
            <div id="bottom">
                <p>Estoque <span>{{ $product->stock }}</span> <i class="fa-solid fa-box"></i></p>
                
                <form action="../carrinho" method="POST" style="width: fit-content;display: flex;">
                    @csrf
                    <input type="hidden" name="id_product" value="{{ $product->id }}"/>
                    <input type="number" name="amount" value="1" class="input-amount-prod-view"/>    
                    <button type="submit">Comprar<i class="fa-solid fa-cart-plus"></i></button>
                </form>

                </div>
            <p><i>Cód.: {{ $product->id }}</i></p>
        </div>
    </div>
</section>

@endsection()