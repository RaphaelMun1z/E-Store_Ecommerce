@extends('layouts.main')
@section('title', 'E-Store - Produtos')
@section('content')

<section class="container-products">
    @if(count($products) < 1 && $search) <!-- Sem produto com pesquisa -->
        <p id="result-searc-number">Não há produtos disponíveis identificados como <b>{{ $search }}</b></p>
        <div class="no-result-container">
            <p>Nenhum produto encontrado</p>
            <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
        </div>
        @elseif(count($products) < 1 && !$search) <!-- Sem produto -->
            <p id="result-searc-number">Não há produtos disponíveis</b></p>
            <div class="no-result-container">
                <p>Nenhum produto encontrado</p>
                <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
            </div>
            @elseif(count($products) > 0 && $search) <!-- Com produto com pesquisa -->
            <p id="result-searc-number">Há <b>{{ $products->total() }}</b> produtos disponíveis identificados como <b>{{ $search }}</b></p>
            @elseif(count($products) > 0 && !$search) <!-- Com produto sem pesquisa -->
            <p id="result-searc-number">Há <b>{{ $products->total() }}</b> produtos disponíveis</b></p>
            @endif

            @if($search)
            <h2 class="title-section-adm"><i class="fa-solid fa-magnifying-glass"></i>{{$search}}</h2>
            @else
            <h2 class="title-section-adm"><i class="fa-solid fa-cubes"></i>Nossos Produtos</h2>
            @endif

            @foreach($products as $product)
            @if($product->stock > 0)
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
                                <p style="width:fit-content;">
                                    <input type="number" name="amount" value="1" class="input-amount-prod"/>    
                                    <button type="submit" style="width: 40px;"><i class="fa-solid fa-cart-plus"></i></button>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="card block-card" style="opacity: .5;">
                <a href="/produtos/{{ $product->id }}" class="card-top">
                    @if($product->image != null)
                    <img src="/img/products/{{ $product->image }}" alt="Imagem de: {{ $product->title }}" />
                    @else
                    <img src="/img/prodImage.png" alt="Produto sem imagem" />
                    @endif
                </a>
                <div class="card-bot">
                    <div class="title">
                        <p>{{ $product->title }}<br>
                            <span style="opacity: .5;">Indisponível</span>
                        </p>
                    </div>
                    <div class="price-cart">
                        <div class="price">
                            <span>R$ </span>
                            <p id="block">{{ number_format($product->price,2,",","."); }}</p>
                        </div>
                        <div class="cart">
                            <form>
                                <input type="hidden" name="id_product" value="{{ $product->id }}" />
                                <p><span><i class="fa-solid fa-cart-plus"></i></span></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            <div class="pagination-footer">
                <div>
                    <p id="result-searc-number">Página {{ $products->currentPage() }}</p>
                    <p style="margin-top: 10px !important;" id="result-searc-number">{{ $products->lastItem() }} de {{ $products->total() }} Resultados</p>
                </div>
                <div class="paginator-prod">
                    {{ $products->appends([
                    'pesquisa' => request()->get('pesquisa', '')
                ])->links() }}
                </div>
            </div>
</section>

@endsection()