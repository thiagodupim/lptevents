@extends('layouts.main')

@section('title', 'Cancelar Viagem')

@section('content')
    <form action="/event/cancel-trip/{{$event->id}}" method="POST">
        @method('POST')
        @csrf
        <div class="form-group">
            <label for="title">Descrição:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Descreva o motivo do cancelamento da viagem" required></textarea>
        </div>
        <input type="submit" class="btn btn-primary" value="Confirmar">
    </form>
    <br> <br> <br> <br> <br> <br> 
@endsection