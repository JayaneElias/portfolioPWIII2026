<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//Essa Migration = Migração:Ela vai servir para cria/alterar a estrutura do banco de dados.
return new class extends Migration

{
    public function up(): void
        {
            //Schema: É a estrutura do banco de dados.
            Schema::create('chirps', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
            });
        }

    //esse método apaga a tabela caso eu volte a migration
    public function down(): void
        {
            Schema::dropIfExists('chirps');
        }

};
