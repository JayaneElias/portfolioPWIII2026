<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Aqui ela(migration) vai encarregado de criar a tabela "chirps"
return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('chirps', function (Blueprint $table) {
                    $table->id();
                    $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
                    $table->string('message', 255);
                    $table->timestamps(); //// Essas são datas automáticas de criação e atualização
            });
        }
            
            public function down(): void
            {
                Schema::dropIfExists('chirps');
            }
    };
