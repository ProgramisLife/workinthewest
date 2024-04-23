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
        Schema::create('job_state', function (Blueprint $table) {
            $table->unsignedBigInteger('jobstate_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('jobstate_id')
                ->references('id')->on('jobstate')
                ->onDelete('CASCADE');

            $table->foreign('job_id')
                ->references('id')->on('jobs')
                ->onDelete('CASCADE');

            $table->unique(['jobstate_id', 'job_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_state');
    }
};
