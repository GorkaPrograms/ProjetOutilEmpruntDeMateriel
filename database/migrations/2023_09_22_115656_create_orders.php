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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Ajoute la colonne de clé étrangère
            $table->unsignedBigInteger('user');
            $table->string("status");
            $table->date("updated_at");
            $table->date("created_at");

            // Définit la contrainte de clé étrangère
            $table->foreign('user')
                ->references('id')
                ->on('user')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Supprime la contrainte de clé étrangère
            $table->dropForeign(['user']);

            // Supprime la colonne de clé étrangère
            $table->dropColumn('user');
        });
    }
};
