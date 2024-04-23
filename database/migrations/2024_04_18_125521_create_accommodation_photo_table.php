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
        Schema::create('accommodation_photo', function (Blueprint $table) {
            $table->unsignedBigInteger('aphoto_id');
            $table->unsignedBigInteger('accommodation_id');

            $table->foreign('aphoto_id')
                ->references('id')->on('aphoto')
                ->onDelete('CASCADE');

            $table->foreign('accommodation_id')
                ->references('id')->on('accommodation')
                ->onDelete('CASCADE');
            $table->unique(['aphoto_id', 'accommodation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_photo', function (Blueprint $table) {
            $table->unique(['aphoto_id', 'accommodation_id']);
        });
    }
};
