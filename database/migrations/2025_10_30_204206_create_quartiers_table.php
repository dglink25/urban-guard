<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{
        Schema::create('quartiers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('liens_google_maps')->nullable();
            $table->foreignId('id_departement')->constrained('departements')->onDelete('cascade');
            $table->foreignId('id_commune')->constrained('communes')->onDelete('cascade');
            $table->foreignId('id_arrondissement')->constrained('arrondissements')->onDelete('cascade');
            $table->foreignId('id_cq')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quartiers');
    }
};
