@extends('layouts.main')

@section('title', 'Inscrição')

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <h1>Inscrição para viagem de consulta</h1>

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
      <label for="image"> 
        Informe os dados corretamente e aguarde a confirmação via WhatsApp Aceite apenas mensagem do número: 38 9 9744 8620.
      </label>
    </div>
    <br>
    <div class="form-group"> 
      <label for="name">Nome completo:</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Insira seu nome completo" value="{{ old('name') }}">
    </div>
    <div class="form-group"> 
      <label for="phone">Telefone:</label>
      <input type="number" class="form-control" id="phone" name="phone" placeholder="Informe seu número de telefone" value="{{ old('phone') }}">
    </div>
    <div class="form-group">
      <label for="exit">Local de embarque:</label>
      <input type="text" class="form-control" id="exit" name="exit" placeholder="Local de saída" value="{{ old('exit') }}">
    </div>
    <div class="form-group">
      <label for="escort">Nome do acompanhante:</label>
      <input type="text" class="form-control" id="escort" name="escort" placeholder="Local da consulta" value="{{ old('escort') }}">
    </div>
    <div class="form-group"> 
      <label for="phone-escort">Telefone do acompanhante:</label>
      <input type="number" class="form-control" id="phone-escort" name="phone-escort" placeholder="Informe seu número de telefone" value="{{ old('phone-escort') }}">
    </div>
    <br>
    <input type="submit" class="btn btn-primary" value="Finalizar inscrição">
  </form>
</div>
@endsection