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
        Schema::create('employee_skill', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('skill_id');

            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->onDelete('CASCADE');

            $table->foreign('skill_id')
                ->references('id')->on('skills')
                ->onDelete('CASCADE');
            $table->unique(['employee_id', 'skill_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_skill');
    }
};
