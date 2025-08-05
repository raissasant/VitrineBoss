<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('imagem_url')->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->string('link_afiliado');
            $table->unsignedBigInteger('plataforma_id');
            $table->unsignedBigInteger('categoria_id');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('plataforma_id')->references('id')->on('plataformas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
