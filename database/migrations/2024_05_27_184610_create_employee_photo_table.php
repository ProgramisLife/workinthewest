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
        Schema::create('employee_photo', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('photo_id');

            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->onDelete('CASCADE');

            $table->foreign('photo_id')
                ->references('id')->on('photos')
                ->onDelete('CASCADE');
            $table->unique(['employee_id', 'photo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_photo');
    }
};
