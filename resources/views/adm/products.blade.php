@extends('layouts.main')
@section('title', 'E-Store - Produtos')
@section('content')

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-cubes"></i>Gerenciamento de Produtos</h2>

    <form method="GET" action="/usuario/adm/produtos" class="form-inline my-2 my-lg-0 mx-auto" style="margin: 20px auto !important;" id="form-container">
        <input name="pesquisa" class="form-control" type="search" placeholder="Busque o(s) produto(s)" aria-label="Search" id="search-input" />
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
                <li><b>Filtrar Título</b> -- Padrão</li>
                <li><b>Filtrar ID Produto</b> -- Começar com <b>#</b></li>
                <li><b>Filtrar Stock vazio</b> -- <b>*</b></li>
                <li><b>Filtrar ID Funcionário</b> -- Começar com <b>%</b></li>
                <li><b>Filtrar ID Categoria</b> -- Começar com <b>!</b></li>
            </ul>
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Fechar
            </button>
        </div>
    </div>

    <table class="table" style="margin: 0;">
        <thead class="thead-dark">
            <tr class="line-table-prods">
                <th scope="col" style="width: 7%;">Código</th>
                <th scope="col" style="width: 30%;">Título</th>
                <th scope="col" style="width: 12%;">Estoque</th>
                <th scope="col" style="width: 12%;">Vendas</th>
                <th scope="col" style="width: 12%;">Preço (R$)</th>
                <th scope="col" style="width: 7%;">Funcionário</th>
                <th scope="col" style="width: 20%;">Ações</th>
            </tr>
        </thead>
        @if(count($products) > 0)
        <tbody>
            @foreach($products as $product)
            <tr class="line-table-prods">
                <th scope="row"><a href="../../produtos/{{ $product->id }}">#{{ $product->id }}</a></th>
                <td style="padding: 20px 0 !important;"><a style="border-radius: 10px;padding: 10px 20px !important;background: #f05928;color: #fff !important;" target="_blank" href="/produtos?pesquisa={{ $product->title }}"><i class="fa-solid fa-eye" style="margin-right: 10px;"></i>{{ $product->title }}</a></td>
                @if($product->stock == 0)
                <td><i class="fa-solid fa-triangle-exclamation"></i></td>
                @else
                <td>{{ $product->stock }} un.</td>
                @endif
                <td>{{ $product->sold }} un.</td>
                <td>R$ {{ number_format($product->price,2,",","."); }}</td>
                <td>#{{ $product->creator_id }}</td>
                <td class="btn-edit-adm" style="min-width: 250px;display: flex;justify-content: space-evenly;">
                    <a type="button" href="/produtos/atualizar/{{ $product->id }}" class="btn btn-warning">Editar <i class="fa-regular fa-pen-to-square"></i></a>
                    <form action="/produtos/{{ $product->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar <i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    @if(!count($products) > 0)
    <div class="no-result-container" style="margin-top: 30px;width:100%;height: 200px;">
        <p>Nenhum produto encontrado</p>
        <img id="box-icon" src="/img/vazio.png" alt="Ícone caixa vazia" />
    </div>
    @endif
</section>

@endsection()