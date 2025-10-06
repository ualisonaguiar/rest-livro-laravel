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
        Schema::create('tb_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ds_nome', 150);
            $table->string('ds_email', 150)->unique();
            $table->string('ds_senha', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_usuario');
    }
};
