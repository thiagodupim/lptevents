@extends('layouts.main') {{--Aqui estamos determinando qual layout estamos extendendo, ou seja usando--}}

@section('title', 'Lista de Inscritos') {{--Aqui estamos definindo o titulo da nossa pagina, atraves da seção title--}}

@section('content') {{-- Aqui estamos iniciando nosso conteudo --}}

<table class="table">
    <thead>
      <tr>
        <th scope="col">Viagem</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($trips as $trip)
            <tr>
                <td>{{ $trip->title }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection