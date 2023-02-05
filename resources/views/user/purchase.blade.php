@extends('layouts.main')
@section('title', 'E-Store - Meus Pedidos')
@section('content')

<section class="container-products" id="new-prod-container">
    <div class="purchase-container">
        <p class="purchhase-number">Pedido <b>#123456</b></p>
        <table class="table" style="margin: 0;">
            <thead class="thead-dark">
                <tr class="line-table-prods">
                    <th scope="col">Imagem</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço (Unidade)</th>
                    <th scope="col">Preço (total produto)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
            </tbody>
        </table>
        <div class="container-info-purchase">
            <div>
                <p>Preço Total: <b>R$ 147.90</b></p>
            </div>
            <div class="button-container-after-table">
                <a type="button" href="#" class="btn btn-info">Rastrear Pedido<i class="fa-solid fa-truck-fast"></i></a>
                <a type="button" href="#" class="btn btn-danger">Cancelar compra <i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>

    <div class="purchase-container">
        <p class="purchhase-number">Pedido <b>#123456</b></p>
        <table class="table" style="margin: 0;">
            <thead class="thead-dark">
                <tr class="line-table-prods">
                    <th scope="col">Imagem</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço (Unidade)</th>
                    <th scope="col">Preço (total produto)</th>
                </tr>
            </thead>
            <tbody>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
                <tr class="line-table-prods">
                    <td>
                        <img class="table-img-prod" src="/img/prodImage.png" />
                    </td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>Otto</td>
                    <td>Otto</td>
                </tr>
            </tbody>
        </table>
        <div class="container-info-purchase">
            <div>
                <p>Preço Total: <b>R$ 147.90</b></p>
            </div>
            <div class="button-container-after-table">
                <a type="button" href="#" class="btn btn-info">Rastrear Pedido<i class="fa-solid fa-truck-fast"></i></a>
                <a type="button" href="#" class="btn btn-danger">Cancelar compra <i class="fa-solid fa-xmark"></i></a>
            </div>
        </div>
    </div>
    
</section>

@endsection()