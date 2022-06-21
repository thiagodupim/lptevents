@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Editando: {{ $event->title }}</h1>
  <form action="/events/update/{{ $event->id }}" method="POST" enctype="multipart/form-data"> {{-- Esse enctype é necessario para poder enviar arquivos por um formulário HTML --}}
    
    @csrf {{-- Essa diretiva é para o laravel deixar enviar o formulário --}}
    @method('PUT')
    <div class="form-group">
      <label for="image">Imagem do evento</label>
        <input type="file" name="image" id="image" class="from-control-file">
        <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview"> {{-- Aqui estamos fazendo uma pré vizualização da imagem do evento --}}
    </div>
    <div class="form-group"> 
      <label for="title">Evento:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}"> 
    </div>
    <div class="form-group">
      <label for="date">Data do evento:</label>
      <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}">
    </div> {{-- Aqui é uma forma de mostrar a data que o evento está marcado, na pág de edição e o Y é maiusculo --}}
    <div class="form-group">
      <label for="title">Cidade:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Local do evento" value="{{ $event->city }}">
    </div>
    <div class="form-group">
      <label for="title">O evento é privado?</label>
      <select name="private" id="private" class="form-control">
        <option value="0">Não</option>
        <option value="1" {{ $event->private == 1 ? "selected='selected'" : ""}}>Sim</option>
      </select> {{-- Fazemos esse if ternário para verificar se o evento é privado ou não, e se não vamos mudar o status do evento --}}
    </div>
    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="O que vai acontecer no evento?">{{ $event->description }}</textarea>
    </div>
    <div class="form-group">
      <label for="title">Adicione itens de infraestrutura</label>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Cadeiras"> Cadeiras {{-- Quando vamos enviar um array de itens(conjunto de itens) temos que colocar entre [] ali no name --}}
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Palco"> Palco
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Cerveja grátis"> Cerveja grátis
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Open Food"> Open Food
      </div>
      <div class="form-group">
        <input type="checkbox" name="items[]" value="Brindes"> Brindes
      </div>
    </div>
    <input type="submit" class="btn btn-primary" value="Editar Evento">
  </form>
</div>

@endsection