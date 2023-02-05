@extends('layouts.main')
@section('title', 'E-Store')
@section('content')

<section class="banners">
    <div class="main-banner">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="/img/1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="/img/2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="/img/3.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="msg">
        <p>Use o cupom <span>E-STORE10</span> para ganhar <span>10%</span> de desconto</p>
    </div>
</section>

<section class="container-products">
    <h1 class="title-sec">Novidades <i class="fa-regular fa-star"></i></h1>
    @foreach($newProds as $product)
    <div class="card">
        <a href="/produtos/{{ $product->id }}" class="card-top">
            @if($product->image != null)
            <img src="/img/products/{{ $product->image }}" alt="Imagem de: {{ $product->title }}" />
            @else
            <img src="/img/prodImage.png" alt="Produto sem imagem" />
            @endif
        </a>
        <div class="card-bot">
            <div class="title">
                <p>{{ $product->title }}</p>
            </div>
            <div class="price-cart">
                <div class="price">
                    <span>R$ </span>
                    <p>{{ number_format($product->price,2,",","."); }}</p>
                </div>
                <div class="cart">
                    <form action="/carrinho" method="POST">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id }}" />
                        <p><button type="submit"><i class="fa-solid fa-cart-plus"></i></button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</section>
<section class="container-products">
    <h1 class="title-sec">Mais Vendidos <i class="fa-solid fa-basket-shopping"></i></h1>
    @foreach($mostSellProds as $product)
    <div class="card">
        <a href="/produtos/{{ $product->id }}" class="card-top">
            @if($product->image != null)
            <img src="/img/products/{{ $product->image }}" alt="Imagem de: {{ $product->title }}" />
            @else
            <img src="/img/prodImage.png" alt="Produto sem imagem" />
            @endif
        </a>
        <div class="card-bot">
            <div class="title">
                <p>{{ $product->title }}</p>
            </div>
            <div class="price-cart">
                <div class="price">
                    <span>R$ </span>
                    <p>{{ number_format($product->price,2,",","."); }}</p>
                </div>
                <div class="cart">
                    <form action="/carrinho" method="POST">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id }}" />
                        <p><button type="submit"><i class="fa-solid fa-cart-plus"></i></button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection()