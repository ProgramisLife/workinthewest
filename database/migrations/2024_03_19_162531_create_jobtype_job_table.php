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
        Schema::create('jobtype_job', function (Blueprint $table) {
            $table->unsignedBigInteger('jobtype_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('jobtype_id')
                ->references('id')->on('jobtypes')
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
        Schema::dropIfExists('jobtype_job');
    }
};
