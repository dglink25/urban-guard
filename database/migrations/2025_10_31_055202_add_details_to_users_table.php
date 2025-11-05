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
        Schema::table('users', function (Blueprint $table) {
            // Ajout seulement si la colonne n'existe pas déjà
            if (!Schema::hasColumn('users', 'id_departement')) {
                $table->foreignId('id_departement')->nullable()->constrained('departements')->nullOnDelete();
            }

            if (!Schema::hasColumn('users', 'id_commune')) {
                $table->foreignId('id_commune')->nullable()->constrained('communes')->nullOnDelete();
            }

            if (!Schema::hasColumn('users', 'id_arrondissement')) {
                $table->foreignId('id_arrondissement')->nullable()->constrained('arrondissements')->nullOnDelete();
            }

            if (!Schema::hasColumn('users', 'id_quartier')) {
                $table->foreignId('id_quartier')->nullable()->constrained('quartiers')->nullOnDelete();
            }

            if (!Schema::hasColumn('users', 'rue')) {
                $table->string('rue')->nullable();
            }

            if (!Schema::hasColumn('users', 'maison')) {
                $table->string('maison')->nullable();
            }

            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['prefet', 'admin', 'maire', 'ca', 'cq', 'conseiller'])->nullable();
            }

            if (!Schema::hasColumn('users', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprime seulement si la colonne existe
            if (Schema::hasColumn('users', 'id_departement')) {
                $table->dropForeign(['id_departement']);
                $table->dropColumn('id_departement');
            }

            if (Schema::hasColumn('users', 'id_commune')) {
                $table->dropForeign(['id_commune']);
                $table->dropColumn('id_commune');
            }

            if (Schema::hasColumn('users', 'id_arrondissement')) {
                $table->dropForeign(['id_arrondissement']);
                $table->dropColumn('id_arrondissement');
            }

            if (Schema::hasColumn('users', 'id_quartier')) {
                $table->dropForeign(['id_quartier']);
                $table->dropColumn('id_quartier');
            }

            if (Schema::hasColumn('users', 'rue')) {
                $table->dropColumn('rue');
            }

            if (Schema::hasColumn('users', 'maison')) {
                $table->dropColumn('maison');
            }

            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

            if (Schema::hasColumn('users', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
