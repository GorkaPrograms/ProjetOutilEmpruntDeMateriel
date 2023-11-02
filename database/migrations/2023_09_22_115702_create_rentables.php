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
        Schema::create('rentables', function (Blueprint $table) {
            $table->id();
            $table->string("rentable_name");
            $table->string("rentable_type");
            $table->integer("total_number");
            $table->string("image");
            $table->date("updated_at");
            $table->date("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentable');
    }
};
