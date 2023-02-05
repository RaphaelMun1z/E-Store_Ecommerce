@extends('layouts.main')
@section('title', 'E-Store - Área do Funcionário')
@section('content')

<section class="container-products" id="new-prod-container" style="justify-content: space-around;">
    <h2 style="margin: 0;" class="title-section-adm">Olá, <b style="margin: 0 0 0 5px;"><a href="/usuario">{{ Auth::user()->name }}</a> <i style="margin-left: 20px;" class="fa-solid fa-mug-hot"></i><i class="fa-regular fa-face-grin-wink"></i><i class="fa-regular fa-hand"></i></b></h2>
    <h2 class="title-section-adm"><i class="fa-solid fa-cubes"></i>Gerenciamento de Produtos</h2>
    <a href="adm/produtos" class="card-userarea" style="background-color: #00FA9A;">
        <div>
            <i class="fa-solid fa-eye"></i>
            <p>Visualizar Situação<br>Produtos</p>
        </div>
    </a>
    <a href="../produtos/cadastrar" class="card-userarea" style="background-color: #00FF00;">
        <div>
            <i class="fa-solid fa-plus"></i>
            <p>Cadastrar Produto</p>
        </div>
    </a>
    <a href="../produtos/deletar" class="card-userarea" style="background-color: #FF0000;">
        <div>
            <i class="fa-solid fa-trash"></i>
            <p>Deletar Produto</p>
        </div>
    </a>
    <h2 class="title-section-adm"><i class="fa-solid fa-layer-group"></i> Gerenciamento de Categorias</h2>
    <a href="../produtos/categoria/adicionar" class="card-userarea" style="background-color: #00FF00;">
        <div>
            <i class="fa-solid fa-plus"></i>
            <p>Cadastrar Categoria</p>
        </div>
    </a>
    <a href="../produtos/categorias" class="card-userarea" style="background-color: #00FA9A;">
        <div>
            <i class="fa-solid fa-eye"></i>
            <p>Visualizar Categorias</p>
        </div>
    </a>
    @if(auth()->user()->accessLevel == 2)
    <h2 class="title-section-adm"><i class="fa-solid fa-clipboard-user"></i>Gerenciamento de Funcionários</h2>
    <a href="../usuario/cadastrar" class="card-userarea" style="background-color: #00FF00;">
        <div>
            <i class="fa-solid fa-user-plus"></i>
            <p>Cadastrar Funcionário</p>
        </div>
    </a>
    <a href="adm/funcionarios" class="card-userarea" style="background-color: #00FA9A;">
        <div>
            <i class="fa-solid fa-clipboard-user"></i>
            <p>Visualizar Situação<br>Funcionários</p>
        </div>
    </a>
    @endif
    <h2 class="title-section-adm"><i class="fa-solid fa-user-gear"></i>Gerenciamento de Clientes</h2>
    <a href="adm/pedidos" class="card-userarea" style="background-color: #95baf7;">
        <div>
            <i class="fa-solid fa-shop"></i>
            <p>Verificar Pedidos</p>
        </div>
    </a>
    <a href="../clientes" class="card-userarea" style="background-color: #00FA9A;">
        <div>
            <i class="fa-solid fa-user-large"></i>
            <p>Visualizar Situação<br>Clientes</p>
        </div>
    </a>
</section>

@endsection()