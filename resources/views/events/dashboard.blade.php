@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

@auth
    @if (Auth::user()->tipo == "admin")
        <div class="col-md-10 offset-md-1 dashboard-title-container">
            <h1>Viagens que criei</h1>
        </div>
        <div class="col-md-10 offset-md-1 dashboard-events-container">
            @if(count($events) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Pacientes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach($events as $event)
                            <tr>
                                <td scropt="row">{{ $loop->index + 1 }}</td>
                                <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                                <td>{{ count($event->users) }}</td> {{-- /*Para imprimir a quantidade de participantes do evento*/ --}}
                                <td>
                                    <a href="/events/edit/{{ $event->id }}" class="btn btn-info edit-btn"> <ion-icon name="create-outline"></ion-icon>Editar Viagem</a> 
                                    <form action="/events/{{ $event->id }}" method="POST">
                                        @csrf 
                                        @method('DELETE') {{-- Aqui estamos induzindo que o metodo para esse formulário é um delete e não um post--}}
                                        <button type="submit" class="btn btn-danger delete-btn"> <ion-icon name="trash-outline"></ion-icon> Desabilitar Viagem </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br> <br> <br> <br> <br> <br>
            @else
                <p>Você ainda não tem viagens criadas, <a href="/events/create">Criar Viagem</a></p>
            @endif
        </div>
    @endif
@endauth

@auth
    @if (Auth::user()->tipo == "client")
        <div class="col-md-10 offset-md-1 dashboard-title-container">
            <h1>Viagens em que me inscrevi</h1>
        </div>
        <div class="col-md-10 offset-md-1 dashboard-events-container">
        <button type="submit" class="btn btn-info edit-btn"> <ion-icon name="create-outline"></ion-icon> Minhas Viagens Arquivadas</button>
            <hr>
            {{-- Abaixo é para mostrar todos os eventos que o usuário participa --}}
            @if(count($eventsasparticipant) > 0) 
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Pacientes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach($eventsasparticipant as $event)
                            <tr>
                                <td scropt="row">{{ $loop->index + 1 }}</td>
                                <td><a href="/events/{{ $event->id }}">{{ $event->title }}</a></td>
                                <td>{{ count($event->users) }}</td> {{-- /*Para imprimir a quantidade de participantes do evento*/ --}}
                                <td>
                                <form action="/events/leave/{{ $event->id }}" method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <ion-icon name="trash-outline"></ion-icon> Cancelar Viagem
                                    </button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else 
                <p>Você ainda não está inscrito de nenhuma viagem, <a href="/">veja todas as viagens</a></p>
                <br> 
            @endif

            <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
            
            
        </div>
    @endif
@endauth

@endsection