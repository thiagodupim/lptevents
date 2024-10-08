@extends('layouts.main')

@section('title', $event->title)

@section('content')

<div class="col-md-10 offset-md-1">
    <div class="row">
        <div id="image-container" class="col-md-6">
            <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
        </div> {{-- Usando o $event->image estamos puxando direto a imagem do evento --}}
        <div id="info-container" class="col-md-6">
            <h1>{{ $event->title }}</h1>
            <p class="event-owner">Agente: {{ $eventOwner['name'] }}</p> {{-- Aqui conseguimos mostrar o nome do usuario que criou o evento --}}
            <p class="event-exit ">Saída:<ion-icon name="location-outline"></ion-icon> {{ $event->exit }}</p>
            <p class="event-city ">Destino:<ion-icon name="location-outline"></ion-icon> {{ $event->city }}</p>
            <p class="events-vagas"><ion-icon name="people-outline"></ion-icon> {{ $event->vagas }} vagas</p>
            <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{ count($event->users) }} Pacientes</p>
            <p class="event-routes">Rotas de paradas: {{ $event->routes }}</p>
            {{--<p class="event-routes">Valor da viagem R${{ $event->price }}</p>--}}
            <br>

            <h3>O veículo conta com:</h3>
            <ul id="items-list">
                @foreach($event->items as $item)
                <li><ion-icon name="play-outline"></ion-icon> <span>{{ $item }}</span></li> {{-- Aqui estamos inserindo os itens que terá no evento e assim vai aparecer la na show.blade --}}
                @endforeach
            </ul>

            @Auth
                @if (Auth::user()->tipo == "client")
                    @if(!$hasUserJoined) {{-- Aqui é para verificar se o usuáio não tiver marcado presença no evento vai aparecer o botão para ele confirmar --}}
                        <form action="/events/join/{{ $event->id }}" method="POST">
                            @csrf
                            <a href="/events/join/{{ $event->id }}" 
                            class="btn btn-primary" 
                            id="event-submit"
                            onclick="event.preventDefaut();
                            this.closet('form').submit();">
                            Inscrever na Viagem
                            </a>
                        </form>
                    @else
                        <p class="already-joined-msg">Você está inscrito nesta viagem!</p>
                    @endif
                @endif
            @endauth
        </div>
        <div class="col-md-12" id="description-container">
            <h3>Sobre a viagem:</h3>
            <p class="event-description">{{ $event->description }}</p>
        </div>
    </div>
    <br> <br>
</div>

@endsection