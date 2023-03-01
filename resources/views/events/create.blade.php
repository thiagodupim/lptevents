@extends('layouts.main')

@section('title', 'Criar Viagem')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Crie uma viagem de consulta</h1>

  @if ($errors->any())
    <ul class="errors">
      @foreach ($errors->all() as $error)
        <li class="error">{{ $error }}</li>
      @endforeach
    </ul>
  @endif

  <form action="/events" method="POST" enctype="multipart/form-data"> {{-- Esse enctype é necessario para poder enviar arquivos por um formulário HTML --}}
    
    @csrf {{-- Essa diretiva é para o laravel deixar enviar o formulário --}}
    <div class="form-group">
      <label for="image">Adicione uma imagem ilustrativa:</label>
        <input type="file" name="image" id="image" class="from-control-file" value="{{ old('image') }}"> {{-- Usamos o old() para persistir os dados já digitados, pois, se ocorrer algum erro a pessoa não precisar digitar tudo novamente --}}
    </div>
    <div class="form-group"> 
      <label for="title">Viagem:</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Insira a viagem" value="{{ old('title') }}">
    </div>
    <div class="form-group">
      <label for="date">Data da viagem:</label>
      <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
    </div>
    <div class="form-group">
      <label for="title">Destino:</label>
      <input type="text" class="form-control" id="city" name="city" placeholder="Local da consulta" value="{{ old('city') }}">
    </div>
    <div class="form-group">
      <label for="title">Vagas para um acompanhante?</label>
      <select name="private" id="private" class="form-control">
        <option value="0">Não</option>
        <option value="1">Sim</option>
      </select>
    </div>
    <div class="form-group">
      <label for="title">Descrição:</label>
      <textarea name="description" id="description" class="form-control" placeholder="Como será a viagem para consulta"></textarea>
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
    <input type="submit" class="btn btn-primary" value="Criar Viagem">
  </form>
</div>

@endsection