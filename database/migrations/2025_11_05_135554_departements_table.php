<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
        Schema::table('departements', function (Blueprint $table) {

            

            if (!Schema::hasColumn('users', 'chef_id')) {
                $table->foreignId('chef_id')->nullable()->constrained('users')->nullOnDelete();
            }

            if (!Schema::hasColumn('users', 'email_officiel')) {
                $table->string('email_officiel')->unique();
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
        //
    }
};
