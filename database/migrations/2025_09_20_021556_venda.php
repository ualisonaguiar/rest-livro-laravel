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
        Schema::create('tb_venda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nu_cpf', 11);
            $table->float('nu_preco');
            $table->integer('nu_quantidade');
            $table->timestamps();

            $table->foreignId('livro_id')
                ->references('id')
                ->on('tb_livro')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_venda');
    }
};
