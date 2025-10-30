<?php

use App\Models\Categoria;
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
        Schema::create('tb_categoria', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_categoria', 100)->unique();
            $table->enum('in_ativo', [Categoria::STATUS_ATIVO, Categoria::STATUS_INATIVO]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_categoria');
    }
};
