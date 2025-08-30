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
        Schema::create('tb_livro', function (Blueprint $table) {
            $table->id();
            $table->string('no_nome', 100);
            $table->string('no_autor', 150);
            $table->integer('nu_quantidade');
            $table->float('nu_preco');
            $table->date('dt_lancamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
