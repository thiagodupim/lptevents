<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactFormResquest;
use App\Models\MensagemContato;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create() {
        return view('contact');
    }

    public function store(StoreContactFormResquest $request)
    {
        $mensagem = new MensagemContato();

        $mensagem->name = $request->name;
        $mensagem->email = $request->email;
        $mensagem->telefone = $request->telefone;
        $mensagem->mensagem = $request->mensagem;

        $mensagem->save();

        return redirect('/');
    }
}
