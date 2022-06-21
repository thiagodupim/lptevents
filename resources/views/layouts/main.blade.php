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
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="/img/hdcevents_logo.svg" alt="LPT Events">
                    </a>
                  
                  <ul class="navbar-nav">
                      <li class="nav-iten">
                          <a href="/" class="nav-link">Eventos</a>
                      </li>
                      <li class="nav-iten">
                            <a href="/events/create" class="nav-link">Criar Eventos</a>
                      </li>
                      @auth {{-- Aqui estamos colocando as alterações do layout para quem já está logado --}}
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus eventos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" 
                                onclick="event.preventDefault(); 
                                    this.closest('form').submit();">Sair</a>
                            </form> {{-- Esta forma acima é para fazer o logout com JS --}}
                        </li>
                      @endauth  
                      @guest {{-- Aqui é para indicar que estamos logado, assim mudara algumas coisas no layout --}}
                        <li class="nav-iten">
                            <a href="/login" class="nav-link">Entrar</a>
                        </li>
                        <li class="nav-iten">
                            <a href="/register" class="nav-link">Cadastrar</a>
                        </li>  
                       @endguest 
                  </ul>  
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
        <p>LPT Events &copy; 2022</p>
    </footer>
    <script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </script> 
    <script  nomodule  src = "https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script>

    </body>
</html>
