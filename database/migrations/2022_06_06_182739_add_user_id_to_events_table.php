<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(); 
        }); /* O foreignId é para chave estrangeira e o constrained é um atributo do laravel para entender que toda a logica insere uma chave estrangeira e atrela ela a um usuário de uma outra tabela*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('cascade'); 
        }); /*Vai deletar os registros que estão atrelados a este usuário */
    }
};
