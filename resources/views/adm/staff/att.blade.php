@extends('layouts.main')
@section('title', 'E-Store - Atualizar Funcionário')
@section('content')

<section class="container-products" id="new-prod-container">
    <form action="/usuario/adm/funcionarios/atualizar/{{ $staff->get(0)->staff['id'] }}" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="public"><i class="fa-solid fa-ranking-star"></i>Publicações</label>
        <input placeholder="Ex.: 8" type="number" min="0" value="{{ $staff->get(0)->staff['publications'] }}" name="publications" required id="public" />

        <input type="hidden" name="id" value="{{ $staff[0]->id }}">

        <label id="label-img" for="img1">
            <p>Escolha a imagem de fundo para seu perfil</p>
            <span id="select-image">
                <i class="fa-solid fa-file-import"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa-solid fa-image"></i>
            </span>
        </label>
        <input type="file" name="bgimage" id="img1" onchange="previewFile1()" />

        <label id="label-img" for="img2" style="margin-top: 50px;">
            <p>Escolha a imagem de perfil</p>
            <span id="select-image">
                <i class="fa-solid fa-file-import"></i>
                <i class="fa-solid fa-arrow-right"></i>
                <i class="fa-solid fa-image"></i>
            </span>
        </label>
        <input type="file" name="profileimage" id="img2" onchange="previewFile2()" />

        <section class="container-products" id="new-prod-container" style="width: fit-content;
box-shadow: none;
margin: 30px auto;">
            <div class="staff-profile">
                <div class="inside-staff-profile">
                    <div>
                        <div class="bg-profile">
                            <img src="/img/adm/{{ $staff[0]->staff['bgimage'] }}" class="prev-img1" />
                        </div>
                        <div class="img-profile">
                            <img src="/img/adm/{{ $staff[0]->staff['profileimage'] }}" class="prev-img2" />
                        </div>
                    </div>
                    <div>
                        <div class="text-profile-staff">
                            <h5>{{ $staff->get(0)['name'] }}</h5>
                            @if($staff->get(0)['accessLevel'] == 1)
                            <p>Gerente</p>
                            @elseif($staff->get(0)['accessLevel'] == 2)
                            <p><i style="margin-right: 5px;" class="fa-solid fa-user-tie"></i>CEO</p>
                            @endif
                        </div>
                        <div>
                            <button type="button" class="btn btn-warning"><i style="margin-right: 5px;" class="fa-solid fa-user-pen"></i>Editar</button>
                            <button type="button" class="btn btn-danger"><i style="margin-right: 5px;" class="fa-solid fa-user-xmark"></i>Deletar</button>
                        </div>
                    </div>
                    <div>
                        <div class="item-profile-staff">
                            <div><i class="fa-solid fa-id-card-clip"></i></div>
                            <div>{{ $staff[0]->id }}</div>
                        </div>
                        <div class="item-profile-staff">
                            <div><i class="fa-solid fa-cart-arrow-down"></i></div>
                            <div id="public-preview">{{ $staff->get(0)->staff['publications'] }}</div>
                        </div>
                        <div class="item-profile-staff">
                            <div><i class="fa-solid fa-calendar-days"></i></div>
                            <div style="text-align: center;font-size: 10pt;">{{ $staff[0]->created_at }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <input type="submit" value="Cadastrar Funcionário" />
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function previewFile1() {
        var preview = document.querySelector(".prev-img1");
        var file = document.querySelector("#img1").files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

    function previewFile2() {
        var preview = document.querySelector(".prev-img2");
        var file = document.querySelector("#img2").files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

    $(".form-save-prod > #public").each(function() {
        $(this).on("keyup", function() {
            $("#public-preview").text($("#public").val());
        })
    })

    $(".form-save-prod > #cargo").each(function() {
        $(this).on("click", function() {
            if ($(this).val() == 1)
                $("#cargo-preview").text("Gerente");
            else if ($(this).val() == 2)
                $("#cargo-preview").text("CEO");
        })
    })
</script>

@endsection()