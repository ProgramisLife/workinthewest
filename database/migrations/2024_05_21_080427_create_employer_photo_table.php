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
            $table->unsignedBigInteger('employer_id');
            $table->unsignedBigInteger('photo_id');

            $table->foreign('employer_id')
                ->references('id')->on('employer')
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
