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
        Schema::create('employer_photo', function (Blueprint $table) {
            $table->unsignedBigInteger('employeer_id');
            $table->unsignedBigInteger('photo_id');

            $table->foreign('employeer_id')
                ->references('id')->on('employeer')
                ->onDelete('CASCADE');

            $table->foreign('photo_id')
                ->references('id')->on('photos')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('employer_photo', function (Blueprint $table) {
        });
    }
};
