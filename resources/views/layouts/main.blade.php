<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonte do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="/css/styles.css">
    <script src="/js/scripts.js"></script>

    <title>@yield('title')</title>

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container">

                <a href="/" class="navbar-brand">
                    <img src="/img/hdcevents_logo.svg" width="50" alt="LPT Events">
                </a>

                <div class="nav-list">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Viagens Disponíveis</a>
                        </li>
                        @auth {{-- Aqui estamos colocando as alterações do layout para quem já está logado --}}
                            @if (Auth::user()->tipo == "admin")
                                <li class="nav-item">
                                    <a href="/events/create" class="nav-link">Criar Viagens</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/" class="nav-link">Listas de Inscritos</a>
                                </li>
                            @endif

                            @if (Auth::user()->tipo == "client")
                                <li class="nav-item">
                                    <a href="/contatos" class="nav-link">Contato</a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a href="/dashboard" class="nav-link">Minhas Viagens</a>
                                </li>
                                <li class="nav-item">
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <a href="/logout" class="nav-link" onclick="event.preventDefault();
                                                this.closest('form').submit();">Sair</a>
                                    </form> {{-- Esta forma acima é para fazer o logout com JS --}}
                                </li>
                        @endauth
                        @guest {{-- Aqui é para indicar que estamos logado, assim mudara algumas coisas no layout --}}
                        <li class="nav-item">
                            <a href="/contatos" class="nav-link">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                @if(session('msg')) <!-- Aqui fazemos um if para verificar se a mensagem veio, pois se ela veio imprimimos o paragrafo msg com a mensagem de sessão, se não veio vai embora -->
                <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="/"><img src="/img/hdcevents_logo.svg" width="50" alt="Imagem da logo"></a>
                </div>

                <div class="col-md-2">
                    <ul class="navbar-nav">
                        <li><a href="/">Viagens Disponíveis</a></li>
                        @auth
                            @if (Auth::user()->tipo == "admin")
                                <li><a href="/events/create">Criar Viagens</a></li>
                                <li><a href="/">Listas de Inscritos</a></li>
                            @endif
                            @if (Auth::user()->tipo == "client")
                                <li><a href="/contatos">Contato</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>

                @auth 
                    <div class="col-md-2">
                        <ul class="navbar-nav">
                            <li><a href="/dashboard">Minhas Viagens</a></li>
                            <li><form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" onclick="event.preventDefault();
                                    this.closest('form').submit();">Sair
                                </a>
                                </form>
                            </li>
                        </ul>
                    </div>   
                @endauth 
                @guest 
                    <div class="col-md-2">
                        <ul class="navbar-nav">
                            <li><a href="/contatos">Contato</a></li>
                            <li><a href="/login">Entrar</a></li>
                            <li><a href="/register">Cadastrar</a></li>
                        </ul> 
                    </div>
                @endguest

                <div class="col-md-3">
                    <ul class="navbar-nav">
                        <li>&copy; Conexão Saúde <br> Todos os direitos reservados</li>

                        <li id="endereco">
                        Vargem do Basto - nº 140 - Zona Rural, Datas - MG, 39130-000
                        </li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <ul>
                        <li>
                            <a href="https://chat.whatsapp.com/FJaZzYI4VGH1O60j0u00ES"><img src="/img/whatsapp.png" width="250px" alt="Icone WhatsApp"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--<p>LPT Events &copy; 2022</p>-->
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"> </script>
    <script nomodule src="https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js"> </script>

</body>

</html>