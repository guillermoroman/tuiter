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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            // Es necesario especificar users en constrained porque si el campo
            // está en blanco, Laravel buscaría la columna 'id' en la tabla
            // follower o followed respectivamente.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
