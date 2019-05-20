<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('nome',120);
            $table->date('nascimento');
            // CPF OU CNPJ
            $table->boolean('tipo_pessoa');
            $table->string('cadastro_nacional',20);
            // Fundação/Nacimento

            $table->date('cliente_desde')->nullable();
            $table->text('descricao')->nullable();

            $table->integer('user_criou')->unsigned()->default('1');
            $table->foreign('user_criou')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_atualizou')->unsigned()->default('1');
            $table->foreign('user_atualizou')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();

            // Se o cliente tiver sido deletado == não ativo
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
        Schema::dropIfExists('clientes');
    }
}
