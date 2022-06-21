<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => 'array' 
    ]; 
    //Aqui está dizendo pro laravel que o items é um array e não uma string
    
    protected $dates = ['date']; //Aqui é para o laravel entender que esse campo é de data também

    protected $guarded = []; //Aqui está dizendo que tudo foi enviado pelo POST pode ser atualizado sem nenhuma restrição. Fiezemos isso aqui para conseguir editar os eventos

    //Abaixo mostra que é um único usuário dono do evento
    public function user() { 
        return $this->belongsTo('App\Models\User');//Quer dizer que vai pertencer a um usuario

    }  
    
    //Abaixo é para dizer que pertence a muitos "belongsToMany"
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

}
