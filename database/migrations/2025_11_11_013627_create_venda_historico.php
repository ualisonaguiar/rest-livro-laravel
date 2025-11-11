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
        Schema::create('tb_venda_historico', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('venda_id')
                ->references('id')
                ->on('tb_venda')
                ->constrained()
                ->onDelete('cascade');

            $table->string('status', 50);
            $table->text('message');
            $table->string('transaction_id', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_venda_historico');
    }
};
