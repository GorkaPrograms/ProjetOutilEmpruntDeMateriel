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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            // Ajoute la colonne de clé étrangère
            $table->unsignedBigInteger('order_reference');
            $table->unsignedBigInteger('rentable');
            $table->string("status");
            $table->date("updated_at");
            $table->date("created_at");

            // Définit la contrainte de clé étrangère
            $table->foreign('order_reference')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
            $table->foreign('rentable')
                ->references('id')
                ->on('rentables')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            // Supprime la contrainte de clé étrangère
            $table->dropForeign(['order_reference']);

            // Supprime la colonne de clé étrangère
            $table->dropColumn('order_reference');

            // Supprime la contrainte de clé étrangère
            $table->dropForeign(['rentable']);

            // Supprime la colonne de clé étrangère
            $table->dropColumn('rentable');
        });
    }
};
