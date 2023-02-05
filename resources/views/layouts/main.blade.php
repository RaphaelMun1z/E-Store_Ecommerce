@php
use \App\Http\Controllers\Controller;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  {{-- Estilos --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="/img/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="/css/style.css">
</head>

<body>

  <div class="overlay"></div>
  <nav class="navbar navbar-expand-md navbar-light bg-light main-menu" style="box-shadow: none">
    <div class="container">
      <button type="button" id="sidebarCollapse" class="btn btn-link d-block d-md-none">
        <i class="bx bx-menu icon-single"></i>
      </button>

      <a class="navbar-brand" href="/">
        <img style="max-height: 80px;object-fit: contain;" src="/img/logo_transparent.png" alt="Logo" />
      </a>

      <ul class="navbar-nav ml-auto d-block d-md-none">
        <li class="nav-item">
          <a class="btn btn-link" href="#">
            <i class="bx bxs-cart icon-single"></i>
            <span class="badge badge-danger">3</span>
          </a>
        </li>
      </ul>

      <div class="collapse navbar-collapse">
        <form method="GET" action="/produtos" class="form-inline my-2 my-lg-0 mx-auto" id="form-container">
          <input name="pesquisa" class="form-control" type="search" placeholder="Busque seu produto..." aria-label="Search" id="search-input" />
          <button class="btn btn-success my-2 my-sm-0" type="submit" id="button-submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>

        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="btn btn-link" href="/carrinho"><i class="bx bxs-cart icon-single"></i>
              <span class="badge badge-danger">{{ session('cartAmount') }}</span></a>
          </li>
          @auth
          @if(auth()->user()->accessLevel >= 1)
          <li class="nav-item ml-md-3 btn-login">
            <a class="btn btn-success log" href="/usuario/adm"><i style="margin-right: 5px;" class="fa-solid fa-gear"></i></i>Minha Área</a>
          </li>
          @elseif(auth()->user()->accessLevel == 0)
          <li class="nav-item ml-md-3 btn-login">
            <a class="btn btn-success log" href="/usuario"><i style="margin-right: 5px;" class="fa-solid fa-house-user"></i></i>Minha Área</a>
          </li>
          @endif
          <form action="/logout" method="POST">
            @csrf
            <li class="nav-item ml-md-3 btn-login">
              <a class="btn btn-danger log" href="/logout" onclick="event.preventDefault(); this.closest('form').submit();"><i style="margin-right: 5px;" class="fa-solid fa-arrow-right-from-bracket"></i>Sair</a>
            </li>
          </form>
          @endauth
          @guest
          <li class="nav-item ml-md-3 btn-login">
            <a class="btn btn-primary log" href="/login"><i class="bx bxs-user-circle mr-1"></i>Entrar / Cadastrar</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  <nav class="navbar navbar-expand-md navbar-light bg-light sub-menu">
    <div class="container">
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mx-auto category">

          <li class="nav-item">
            <a class="nav-link" href="/">Início</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/produtos">Nossos Produtos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="/produtos/categorias">Categorias</a>
          </li>

          @foreach(Controller::navBarCat() as $t)
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ $t->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              @foreach(Controller::navBarCatItems($t) as $p)
              <a class="dropdown-item" href="/produtos?pesquisa={{ $p->title }}">{{ $p->title }}</a>
              @endforeach
            </div>
          </li>
          @endforeach

        </ul>
      </div>
    </div>
  </nav>

  <div class="search-bar d-block d-md-none">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <form class="form-inline mb-3 mx-auto">
            <input class="form-control" type="search" placeholder="Busque seu produto..." aria-label="Search" />
            <button class="btn btn-success" type="submit">
              <i class="bx bx-search"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-10 pl-0">
            <a class="btn btn-primary" href="#"><i class="bx bxs-user-circle mr-1"></i> Log In</a>
          </div>

          <div class="col-2 text-left">
            <button type="button" id="sidebarCollapseX" class="btn btn-link">
              <i class="bx bx-x icon-single"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <ul class="list-unstyled components links">
      <li class="active">
        <a href="#"><i class="bx bx-home mr-3"></i> Home</a>
      </li>
      <li>
        <a href="#"><i class="bx bx-carousel mr-3"></i> Products</a>
      </li>
      <li>
        <a href="#"><i class="bx bx-book-open mr-3"></i> Schools</a>
      </li>
      <li>
        <a href="#"><i class="bx bx-crown mr-3"></i> Publishers</a>
      </li>
      <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="bx bx-help-circle mr-3"></i> Support</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
          <li>
            <a href="#">Delivery Information</a>
          </li>
          <li>
            <a href="#">Privacy Policy</a>
          </li>
          <li>
            <a href="#">Terms & Conditions</a>
          </li>
        </ul>
      </li>
      <li>
        <a href="#"><i class="bx bx-phone mr-3"></i> Contact</a>
      </li>
    </ul>

    <h6 class="text-uppercase mb-1">Categories</h6>
    <ul class="list-unstyled components mb-3">
      <li>
        <a href="#">Category 1</a>
      </li>
      <li>
        <a href="#">Category 1</a>
      </li>
      <li>
        <a href="#">Category 1</a>
      </li>
      <li>
        <a href="#">Category 1</a>
      </li>
      <li>
        <a href="#">Category 1</a>
      </li>
      <li>
        <a href="#">Category 1</a>
      </li>
    </ul>

    <ul class="social-icons">
      <li>
        <a href="#" target="_blank" title=""><i class="bx bxl-facebook-square"></i></a>
      </li>
      <li>
        <a href="#" target="_blank" title=""><i class="bx bxl-twitter"></i></a>
      </li>
      <li>
        <a href="#" target="_blank" title=""><i class="bx bxl-linkedin"></i></a>
      </li>
      <li>
        <a href="#" target="_blank" title=""><i class="bx bxl-instagram"></i></a>
      </li>
    </ul>
  </nav>

  @if(session()->get('msg'))
  @if(session()->get('stts') == 1)
  <div class="alert alert-p" id="popup">
    <span class="closebtn-popup" onclick="this.parentElement.style.display='none';">&times;</span>
    {{ session()->get('msg') }}
  </div>
  @elseif(session()->get('stts') == 0)
  <div class="alert alert-n" id="popup">
    <span class="closebtn-popup" onclick="this.parentElement.style.display='none';">&times;</span>
    {{ session()->get('msg') }}
  </div>
  @else
  <div class="alert" id="popup">
    <span class="closebtn-popup" onclick="this.parentElement.style.display='none';">&times;</span>
    {{ session()->get('msg') }}
  </div>
  @endif
  @endif

  @yield('content')

  <!-- Footer -->
  <footer class="text-center text-lg-start bg-light text-muted" style="border-radius: 20px;margin-top: 20px;">
    <!-- Section: Social media -->
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>Visite nossas redes sociais:</span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-google"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-linkedin"></i>
        </a>
        <a href="" class="me-4 text-reset">
          <i class="fab fa-github"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>E-Store
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Produtos
            </h6>

            @foreach(Controller::navBarCat() as $t)
            <p>
              <a href="/produtos?pesquisa={{ $t->name }}" class="text-reset"> {{ $t->name }}</a>
            </p>
            @endforeach
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Links Rápidos
            </h6>
            <p>
              <a href="/produtos" class="text-reset">Todos Produtos</a>
            </p>
            <p>
              <a href="/carrinho" class="text-reset">Meu Carrinho</a>
            </p>
            <p>
              <a href="/usuario" class="text-reset">Minha Área</a>
            </p>
            <p>
              <a href="/cliente/pedidos" class="text-reset">Minhas Compras</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">Contato</h6>
            <p><i class="fas fa-home me-3"></i> São Paulo - BR</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              estore@gmail.com
            </p>
            <p><i class="fas fa-phone me-3"></i> +55 (11) 1234-5679</p>
            <p><i class="fas fa-print me-3"></i> +55 (11) 1234-5678</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2023 Copyright:
      <a class="text-reset fw-bold" href="#">E-Store.com</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="/js/script.js"></script>
</body>

</html>