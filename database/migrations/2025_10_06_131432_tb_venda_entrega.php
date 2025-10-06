<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_venda_entrega', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_id')->unique();
            $table->string('nu_cep', 8);
            $table->string('ds_logradouro', 300);
            $table->string('ds_complemento', 100);
            $table->string('ds_bairro', 100);
            $table->integer('nu_ibge');
            $table->string('ds_municipio', 100);
            $table->string('ds_estado', 2);
            $table->string('ds_numero', 10);
            $table->timestamps();

            $table->foreign('venda_id')
                ->references('id')
                ->on('tb_venda')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_venda_entrega');
    }
};
