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
        Schema::create('certificado_digitals', function (Blueprint $table) {
            $table->id('uuid');
            $table->uuid('token_company');
            $table->string('emitente_uuid');
            $table->string('certificado_nome_arquivo', 60);
            $table->binary('certificado_arquivo_binario');
            $table->string('certificado_senha', 60);

            $table->string('cnpj', 80);
            $table->string('serial', 80);
            $table->string('inicio', 80);
            $table->string('expiração', 100);
            $table->string('identificador', 150);
            $table->string('idctx', 200);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificado_digitals');
    }
};
