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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('image');
            $table->string('title');
            $table->dateTime('date');
            $table->text('description');
            $table->string('exit');
            $table->string('city');
            $table->text('routes');
            $table->boolean('private');
            $table->string('transport');
            $table->integer('vagas');
            $table->json('items');
            $table->enum('canceled',['cancelado' , 'ativo'])->default('ativo');
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
