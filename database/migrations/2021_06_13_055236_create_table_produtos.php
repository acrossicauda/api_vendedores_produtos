<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('produtos')) {
            // ID, Nome e CPF (não precisa validar);
            Schema::create('produtos', function (Blueprint $table) {
                $table->id('idproduto');
                $table->foreignId('idvendedor')->nullable()->references('idvendedor')->on('vendedores');
                $table->string('nomeproduto');
                $table->string('preco');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
