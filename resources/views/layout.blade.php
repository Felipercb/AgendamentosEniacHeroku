<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('index.css'); }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('form.css'); }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.2.js"></script>
    
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary px-5" > 
      <div style="font-size:20px;" class="container-fluid display-1">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="home" href="/home">Home</a>
          </li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        @auth
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="home" href="/meusagendamentos">Meus agendamentos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="/agendar">Agendar</a>
            </li>

            @if ($admin || $suporte)
            <li class="nav-item">
              <a class="nav-link active" href="/suporte">Suporte</a>
            </li>
            @endif 

            @if ($admin)
            <li class="nav-item">
              <a class="nav-link active" href="/configuracoes">Configurações</a>
            </li>
            @endif

            @if ($admin)
            <li class="nav-item">
              <a class="nav-link active" href="/controle">Controle</a>
            </li>
            @endif

          </ul>
          <a style="margin-top:5px;" class="navbar-brand">
            <img src="{{ Auth::user()->foto }}" class="rounded-circle mb-1" width="30" height="30">
          </a>
          <a class="navbar-brand">{{ Auth::user()->name }}</a>
        </div>
        @endauth
       
      
        @auth
        <form action="/logout" method="POST" >
            @csrf
            <button class="btn btn-danger btn-sm btn-vermelho-sair" type="submit">
                Sair <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
        @endauth
        @guest
        <form action="/login" method="get" >
            <button class="btn btn-primary btn-entrar" type="submit">
              Entrar <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
        @endguest

      </div>
    </nav>

    <div class="container container-principal">
     
</head>

        <div class="jumbotron">
            <h2>@yield('cabecalho')</h2>
            @yield('erro')
        </div>

        @yield('conteudo')

    </div>


<body class="body">
    