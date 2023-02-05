@extends('layouts.main')
@section('title', 'E-Store - Deletar Produto')
@section('content')

<section class="container-products" id="new-prod-container">
    <h2 class="title-section-adm"><i class="fa-solid fa-box-open"></i>Deletar Produto</h2>
    <form action="" method="POST" class="form-save-prod" enctype="multipart/form-data">
        @csrf
        @method('DELETE')

        <label for="prod_cod"><i class="fa-solid fa-magnifying-glass"></i>Código do produto</label>
        <input placeholder="Ex.: 214" min="1" type="number" name="prod_cod" id="prod_cod" required />

        <input type="submit" id="btn" value="Deletar produto" class="del-button" name="ready" />
    </form>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $("#prod_cod").on("input", function() {
        $input = $(this).val();
    });

    $default = "../produtos/";
    $input = "";
    $('#btn').click(function() {
        if ($input != "" && $input > 0)
            $('form').attr('action', $default + $input);
    });
</script>

@endsection()