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
        Schema::create('employers_photo', function (Blueprint $table) {
            $table->unsignedBigInteger('employers_id');
            $table->unsignedBigInteger('photo_id');

            $table->foreign('employers_id')
                ->references('id')->on('employers')
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
       Schema::dropIfExists('employers_photo', function (Blueprint $table) {
        });
    }
};
