@extends('layouts.main')
@section('title', 'E-Store - Funcionários')
@section('content')

<section class="container-products" style="justify-content: space-around;">
    <h2 class="title-section-adm"><i class="fa-solid fa-people-group"></i>Funcionários</h2>

    <form method="GET" action="/usuario/adm/funcionarios" class="form-inline my-2 my-lg-0 mx-auto" style="margin: 20px auto !important;" id="form-container">
        <input name="pesquisa" class="form-control" type="search" placeholder="Busque o(s) funcionário(s)" aria-label="Search" id="search-input" />
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
                <li><b>Filtrar Nome</b> -- Padrão</li>
                <li><b>Filtrar por Email</b> -- Começar com <b>@</b></li>
                <li><b>Filtrar ID Funcionário</b> -- Começar com <b>#</b></li>
                <li><b>Filtrar ID Usuário</b> -- Começar com <b>%</b></li>
            </ul>
            <button class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Fechar
            </button>
        </div>
    </div>

    @if(count($staffs) > 0)
    @foreach($staffs as $key => $staff)
    <div class="staff-profile">
        <div class="inside-staff-profile">
            <div>
                <div class="bg-profile">
                    @if($staffs->get($key)->staff['bgimage'])
                    <img src="/img/adm/{{ $staffs->get($key)->staff['bgimage'] }}" />
                    @else
                    <img src="/img/adm/fundodefault.jpg" />
                    @endif
                </div>
                <div class="img-profile">
                    @if($staffs->get($key)->staff['profileimage'])
                    <img src="/img/adm/{{ $staffs->get($key)->staff['profileimage'] }}" />
                    @else
                    <img src="/img/adm/profiledefault.png" />
                    @endif
                </div>
            </div>
            <div>
                <div class="text-profile-staff">
                    <h5>{{ $staff->name }}</h5>
                    @if($staff->accessLevel == 1)
                    <p>Gerente</p>
                    @elseif($staff->accessLevel == 2)
                    <p><i style="margin-right: 5px;" class="fa-solid fa-user-tie"></i>CEO</p>
                    @endif
                </div>
                <div style="display: flex;">
                    <a style="margin-right: 10px;" href="/usuario/adm/funcionarios/atualizar/{{ $staff->id }}" class="btn btn-warning"><i style="margin-right: 5px;" class="fa-solid fa-user-pen"></i>Editar</a>
                    <form action="/usuario/adm/funcionarios/deletar/{{ $staff->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Deletar<i style="margin-left: 5px;" class="fa-regular fa-trash-can"></i></button>
                    </form>
                </div>
            </div>
            <div>
                <div class="item-profile-staff">
                    <div><i class="fa-solid fa-id-card-clip"></i></div>
                    <div>{{ $staff->id }}</div>
                </div>
                <div class="item-profile-staff">
                    <div><i class="fa-solid fa-cart-arrow-down"></i></div>
                    <div>{{ $staffs->get($key)->staff['publications'] }}</div>
                </div>
                <div class="item-profile-staff">
                    <div><i class="fa-solid fa-calendar-days"></i></div>
                    <div style="text-align: center;font-size: 10pt;">@if($staffs->get($key)->staff['created_at']){{ date('d/m/Y H:i', strtotime($staffs->get($key)->staff['created_at'])) }}@endif</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="no-result-container" style="margin-top: 30px;width:100%;height: 200px;">
        <p>Nenhum funcionário encontrado</p>
    </div>
    @endif

    <div class="pagination-footer">
        <div>
            <p id="result-searc-number">Página {{ $staffs->currentPage() }}</p>
            <p style="margin-top: 10px !important;" id="result-searc-number">{{ $staffs->lastItem() }} de {{ $staffs->total() }} Resultados</p>
        </div>
        <div class="paginator-prod">
            {{ $staffs->appends([
                    'pesquisa' => request()->get('pesquisa', '')
                ])->links() }}
        </div>
    </div>
</section>

@endsection()