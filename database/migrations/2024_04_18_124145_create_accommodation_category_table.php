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
        Schema::create('accommodation_category', function (Blueprint $table) {
            $table->unsignedBigInteger('acategory_id');
            $table->unsignedBigInteger('accommodation_id');

            $table->foreign('acategory_id')
                ->references('id')->on('acategory')
                ->onDelete('CASCADE');

            $table->foreign('accommodation_id')
                ->references('id')->on('accommodation')
                ->onDelete('CASCADE');
            $table->unique(['acategory_id', 'accommodation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_category', function (Blueprint $table) {
            $table->unique(['acategory_id', 'accommodation_id']);
        });
    }
};
