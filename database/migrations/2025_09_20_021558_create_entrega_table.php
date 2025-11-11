<?php

use App\Models\Entrega;
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
        Schema::create('tb_entrega', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('venda_entrega_id')->unique();
            $table->string('nu_cep_destino', 8);
            $table->string('ds_ticket', 50);
            $table->decimal('nu_preco_frete', 10, 2);
            $table->string('ds_tipo_entrega', 50);
            $table->integer('nu_prazo_entrega');
            $table->string('status', 9);
            $table->timestamps();

            $table->foreign('venda_entrega_id')
                ->references('id')
                ->on('tb_venda_entrega')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_entrega');
    }
};
