@extends('layouts.main') {{--Aqui estamos determinando qual layout estamos extendendo, ou seja usando--}}

@section('title', 'LPT Events') {{--Aqui estamos definindo o titulo da nossa pagina, atraves da seção title--}}

@section('content') {{-- Aqui estamos iniciando nosso conteudo --}}

<div id="search-container" class="col-md-12">
    <h1>Busque por um evento</h1>
    <form action="/" method="GET">
        <input type="text" name="search" id="search" class="form-control" placeholder="Procurar...">
    </form>
</div>
<div id="events-container" class="col-md-12">
    @if($search)
        <h2>Buscando por: {{ $search }}</h2>
    @else
        <h2>Próximos Eventos</h2>
        <p class="subtitle">Veja os eventos dos próximos dias</p>
    @endif

    <div id="cards-container" class="row">
        @foreach($events as $event)
        <div class="card col-md-3">
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}"> {{-- Para não vim mais a imagem estática. Aqui concatenamos com nosso $events->image e vim a imagem correta do upload --}}
            <div class="card-body">
                <p class="card-date">{{ date('d/m/Y', strtotime($event->date)) }}</p> {{-- Aqui vai transferir o formato de datas lá do banco o strtotime e a função date vai fazer o format para o formato que agente precisa --}}
                <h5 class="card-title">{{ $event->title }}</h5>
                <p class="card-participants"> {{ count($event->users) }} participantes</p>
                <a href="/events/{{ $event->id }}" class="btn btn-primary">Saber mais</a> {{-- Esse link leva ao acesso  a rota show--}}
            </div>
        </div>
        @endforeach
        @if(count($events) == 0 && $search)
            <p>Não foi possivel encontrar nenhum evento com {{ $search }}! <a href="/">Ver todos</a></p>
        @elseif(count($events) == 0)
            <p>Não há eventos disponíveis</p>
        @endif
    </div>
</div>

@endsection