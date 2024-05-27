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
        Schema::create('experience_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('experience_id');

            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->onDelete('CASCADE');

            $table->foreign('experience_id')
                ->references('id')->on('experiences')
                ->onDelete('CASCADE');
            $table->unique(['employee_id', 'experience_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experience_employee');
    }
};
