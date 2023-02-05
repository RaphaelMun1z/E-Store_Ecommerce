@extends('layouts.main')
@section('title', 'E-Store - Carrinho')
@section('content')

<section class="container-products">
    <h2 class="title-section-adm"><i class="fa-solid fa-cart-shopping"></i>Seu Carrinho</h2>

    @if(count($produtos) > 0)
    @foreach($produtos as $p)
    <div class="cart-item">
        <div class="cart-item-sec">
            <img src="/img/products/{{ $p['image'] }}" />
        </div>
        <div class="cart-item-sec">
            <p>{{ $p['title'] }}</p>
        </div>
        <div class="cart-item-sec">
            <div id="number-items" class="input-amount">
                <div class="btn-number-items-cart less" onclick="dec(`{{ $p['id'] }}`)"><i class="fa-solid fa-minus"></i></div>
                <input type="number" class="qitems" id="input_amount" value="{{ $p['amount_product'] }}" min="1" max="{{ $p['stock'] }}" />
                <div class="btn-number-items-cart more" onclick="inc(`{{ $p['id'] }}`)"><i class="fa-solid fa-plus"></i></div>
            </div>
        </div>
        <div class="cart-item-sec">
            <p class="value"><b>R$</b>{{ number_format($p['amount_product'] * $p['price'],2,",","."); }}</p>
        </div>

        <div style="position: absolute;
display: flex;
width: 100%;
height: fit-content;
bottom: 0;
justify-content: flex-end;
padding: 10px 15px;">
            <form action="/carrinho/del/{{ $p['id'] }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir<i style="margin-left: 5px;" class="fa-regular fa-trash-can"></i></button>
            </form>
        </div>
    </div>

    @endforeach

    <div class="end-cart">
        <p class="total-cart">Total: <b>R$</b> {{ number_format($total,2,",","."); }}</p>
        <a style="color: #fff !important;" href="carrinho/finalizar" type="button" class="btn btn-success">Finalizar Compra <i style="margin-left: 5px;" class="fa-solid fa-check"></i></a>
    </div>
    @else
    <div class="no-result-container" style="height: 200px;">
        <p>Nenhum produto em seu carrinho</p>
        <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
    </div>
    @endif

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(".btn-number-items-cart").each(function(e) {
        $(this).on("click", function(e) {
            if ($(this).hasClass("less")) {
                if (parseInt($(this).siblings("#input_amount").val()) > 1)
                    $(this).siblings("#input_amount").val(parseInt($(this).siblings("#input_amount").val()) - 1);
            } else {
                $(this).siblings("#input_amount").val(parseInt($(this).siblings("#input_amount").val()) + 1);
            }
        });
    });

    function inc(id) {
        window.location.href = "/carrinho/inc/" + id;
    }

    function dec(id) {
        window.location.href = "/carrinho/dec/" + id;
    }
</script>
@endsection()