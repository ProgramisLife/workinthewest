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
        Schema::create('photo_job', function (Blueprint $table) {
            $table->unsignedBigInteger('photo_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('photo_id')
                ->references('id')->on('photos')
                ->onDelete('CASCADE');

            $table->foreign('job_id')
                ->references('id')->on('jobs')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photo_job');
    }
};
