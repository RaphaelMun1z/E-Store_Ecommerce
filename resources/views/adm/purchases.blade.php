@extends('layouts.main')
@section('title', 'E-Store - Pedidos dos Clientes')
@section('content')

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-cart-shopping"></i>Pedidos</h2>

    <form method="GET" action="/usuario/adm/pedidos" class="form-inline my-2 my-lg-0 mx-auto" style="margin: 20px auto !important;" id="form-container">
        <input name="pesquisa" class="form-control" type="search" placeholder="Busque o(s) pedido(s)" aria-label="Search" id="search-input" />
        <button class="btn btn-success my-2 my-sm-0" type="submit" id="button-submit">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <p style="margin: 20px auto;
position: relative;
display: flex;
width: 100%;
justify-content: center;
align-content: center;">
        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Dicas de filtro
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div style="margin-bottom: 30px;" class="card card-body">
            <ul>
                <li><b>Filtrar por ID Pedido</b> -- Começar com <b>#</b></li>
                <li><b>Filtrar por ID Cliente</b> -- Começar com <b>@</b></li>
                <li><b>Filtrar por Status Envio</b> -- Começar com <b>!</b></li>
            </ul>
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Fechar
            </button>
        </div>
    </div>

    @if(count($pedidos) > 0)
    @foreach($pedidos as $p)

    <div class="purchase-container">
        <div class="purchhase-number">
            <p>Código Pedido: <b>#{{ $p->id }}</b></p>
            <p class="info-purchase-table">Pedido Realizado em: <b>{{ date('d/m/Y H:i', strtotime($p['created_at'])) }}</b></p>
            <p class="info-purchase-table">Código Cliente: <b>#{{ $p->user_id }}</b></p>
            <p class="info-purchase-table">Nome Cliente: <b>
                    @if(isset($p->user['name']))
                    {{ $p->user['name'] }}
                    @else
                    Cliente não registrado
                    @endif</b></p>
            <p class="info-purchase-table">Status de Envio: </p>

            <div class="purchase-send-status">
                @if($p->status > 0)
                <div style="color: #fff;background: #9af24e;border: none;" class="btn btn-info">Preparando para Envio<i style="margin-left: 5px;" class="fa-solid fa-boxes-packing"></i></div>
                <span id="purchase-send-status-bar" style="background: #9af24e;margin: auto -17px auto 0;"></span>
                @if($p->status == 1)<i style="color: #f45c24;margin: -10px 0 0 0;" class="fa-solid fa-truck-fast"></i>@endif
                <span id="purchase-send-status-bar" style="background: #9af24e;margin: auto 0 auto -17px;"></span>
                @endif
                @if($p->status > 1)
                <div style="color: #fff;background: rgb(255, 191, 0);border: none;" class="btn btn-info">Pedido Postado<i style="margin-left: 5px;" class="fa-regular fa-paper-plane"></i></div>
                <span id="purchase-send-status-bar" style="background: rgb(255,191,0);margin: auto -17px auto 0;"></span>
                @if($p->status == 2)<i style="color: #f45c24;margin: -10px 0 0 0;" class="fa-solid fa-truck-fast"></i>@endif
                <span id="purchase-send-status-bar" style="background: rgb(255,191,0);margin: auto 0 auto -17px;"></span>
                @endif
                @if($p->status > 2)
                <div style="color: #fff;background: rgb(255, 191, 0);border: none;" class="btn btn-info">Pedido a Caminho<i style="margin-left: 5px;" class="fa-solid fa-plane"></i></div>
                <span id="purchase-send-status-bar" style="background: rgb(255,191,0);margin: auto -17px auto 0;"></span>
                @if($p->status == 3)<i style="color: #f45c24;margin: -10px 0 0 0;" class="fa-solid fa-truck-fast"></i>@endif
                <span id="purchase-send-status-bar" style="background: rgb(255,191,0);margin: auto 0 auto -17px;"></span>
                @endif
                @if($p->status > 3)
                <div style="color: #fff;background: #0af521;border: none;" class="btn btn-info"> Pedido Entregue<i style="margin-left: 5px;" class="fa-solid fa-check"></i></div>
                @endif
            </div>
        </div>
        <table class="table" style="margin: 0;">
            <thead class="thead-dark">
                <tr class="line-table-prods">
                    <th scope="col">Imagem</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                </tr>
            </thead>
            <tbody>
                @for($ii = 0; $ii < count($p->orderitems); $ii++)
                    @if(isset($p->orderitems[$ii]->products))
                    <tr class="line-table-prods">
                        <td>
                            <img style="object-fit: contain;" class="table-img-prod" src="/img/products/{{ $p->orderitems[$ii]->products->image }}" />
                        </td>
                        <td>{{ $p->orderitems[$ii]->products->title }}</td>
                        <td>{{ $p->orderitems[$ii]->amount_product }} un.</td>
                        <td>R$ {{ number_format($p->orderitems[$ii]->products->price * $p->orderitems[$ii]->amount_product,2,",","."); }}</td>
                    </tr>
                    @else
                    <tr class="line-table-prods">
                        <td>
                            <img class="table-img-prod" src="/img/products/7cd743a47b402f67c1e46225d4da2af3.png" />
                        </td>
                        <td><i>Produto Deletado<i style="margin-left: 10px;" class="fa-solid fa-triangle-exclamation"></i></i></td>
                        <td>{{ $p->orderitems[$ii]->amount_product }} un.</td>
                        <td><i class="fa-solid fa-triangle-exclamation"></i></td>
                    </tr>
                    @endif
                    @endfor
            </tbody>
        </table>
        <div class="container-info-purchase">
            <div>
                <p>Preço Total: <b>R$ {{ number_format(array_sum($total[$p->id]),2,",","."); }}</b></p>
            </div>
            <div class="button-container-after-table" style="border: none;">
                @if($p->status != 4)
                <form action="/usuario/adm/pedidos/atualizar/{{ $p->id }}" method="POST" style="margin-right: 10px;color:#fff;cursor: auto;" class="btn btn-info form-status-purchase">
                    @csrf
                    @method('PUT')
                    <p style="margin: 10px 0;font-weight: 600;">Editar Rastreio<i class="fa-solid fa-truck-fast"></i></p>
                    <select name="status" style="margin-right: 10px;cursor: pointer;" class="form-select select-status-purchase" aria-label="Default select example">
                        <option value="1" style="background: #9af24e;" @if($p->status == 1) selected @endif><a href="#1">Preparando Envio</a></option>
                        <option value="2" style="background: rgb(255, 191, 0);" @if($p->status == 2) selected @endif><a href="#2">Postado</a></option>
                        <option value="3" style="background: rgb(255, 191, 0);" @if($p->status == 3) selected @endif><a href="#3">A caminho</a></option>
                        <option value="4" style="background: #0af521;" @if($p->status == 4) selected @endif><a href="#4">Entregue</a></option>
                    </select>
                </form>

                <form action="/usuario/adm/pedidos/{{ $p->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="padding: 20px;" type="submit" class="btn btn-danger">Cancelar<br>Pedido<i class="fa-solid fa-ban"></i></button>
                </form>
                @endif
            </div>
        </div>
    </div>

    @endforeach
    @else
    <div class="no-result-container" style="margin: 30px auto;">
        <p>Nenhum pedido realizado até o momento</p>
        <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
    </div>
    @endif

    <div class="pagination-footer">
        <div>
            <p id="result-searc-number">Página {{ $pedidos->currentPage() }}</p>
            <p style="margin-top: 10px !important;" id="result-searc-number">{{ $pedidos->lastItem() }} de {{ $pedidos->total() }} Resultados</p>
        </div>
        <div class="paginator-prod">
            {{ $pedidos->appends([
                    'pesquisa' => request()->get('pesquisa', '')
                ])->links() }}
        </div>
    </div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(".form-status-purchase > .select-status-purchase").each(function() {
        jQuery(this).children("option").each(function() {
            $(this).on("click", function() {
                $(this).closest('form').submit();
            });
        })
    })
</script>

@endsection()