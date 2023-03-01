@extends('layouts.main')

@section('title', 'Contatos')

@section('content')

<center>
<div class="container contact-form">
            <div class="contact-image">
                <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
            </div>
            @if ($errors->any())
                <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li class="error">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form action="/contatos" method="POST">
            @csrf
                <h3>Envie-nos uma mensagem</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nome *" />
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email *"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone *"/>
                        </div>
                        <center>
                            <div class="form-group">
                                <input type="submit" name="btnSubmit" class="btnContact" value="Enviar Mensagem" />
                            </div>
                        </center>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" id="mensagem" name="mensagem" placeholder="Sua mensagem *" style="width: 100%; height: 150px;"></textarea>
                        </div>
                    </div>
                </div>
            </form>
</div>
</center>

@endsection