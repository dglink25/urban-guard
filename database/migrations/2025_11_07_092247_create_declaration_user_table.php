<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('declaration_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('declaration_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Empêche les doublons
            $table->unique(['declaration_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('declaration_user');
    }
};