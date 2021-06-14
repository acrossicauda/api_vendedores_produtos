<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVendedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vendedores')) {
            // ID, Nome e CPF (não precisa validar);
            Schema::create('vendedores', function (Blueprint $table) {
                $table->id('idvendedor');
                $table->string('nomevendedor');
                $table->string('cpfvendedor');
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
        Schema::dropIfExists('vendedores');
    }
}
