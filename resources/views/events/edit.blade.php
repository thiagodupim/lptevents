@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{ $event->title }}</h1>

  @if ($errors->any())
    <ul class="errors">
      @foreach ($errors->all() as $error)
        <li class="error">{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data"> {{-- Esse enctype é necessario para poder enviar arquivos por um formulário HTML --}}
    
    @csrf {{-- Essa diretiva é para o laravel deixar enviar o formulário --}}
    @method('PUT')
    <div class="form-group">
      <label for="image">Imagem do ilustrativa</label>
        <input type="file" name="image" id="image" class="from-control-file">
        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview"> {{-- Aqui estamos fazendo uma pré vizualização da imagem do evento --}}
    </div>
    <div class="form-group"> 
      <label for="title">Viagem:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Insira a viagem" value="{{ $event->title }}"> 
    </div>
    <div class="form-group">
      <label for="date">Data da viagem:</label>
      <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
    </div> {{-- Aqui é uma forma de mostrar a data que o evento está marcado, na pág de edição e o Y é maiusculo --}}
    <div class="form-group">
      <label for="title">Destino:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Local da consulta" value="{{ $event->city }}">
    </div>
    <div class="form-group">
      <label for="title">Vagas para um acompanhante?</label>
      <select name="private" id="private" class="form-control">
        <option value="0">Não</option>
        <option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
      </select> {{-- Fazemos esse if ternário para verificar se o evento é privado ou não, e se não vamos mudar o status do evento --}}
    </div>
    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer na viagem?">{{ $event->description }}</textarea>
    </div>
    <div class="form-group">
      <label for="title">O ônibus conta com:</label>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Rampa para cadeirantes"> Rampa para cadeirantes {{-- Quando vamos enviar um array de itens(conjunto de itens) temos que colocar entre [] ali no name --}}
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Banheiro"> Banheiro
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Frigobar"> Frigobar
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Ar-condicionado"> Ar-condicionado
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Wi-fi"> Wi-Fi
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Editar Viagem">
  </form>
</div>

@endsection