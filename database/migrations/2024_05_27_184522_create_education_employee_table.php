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
        Schema::create('education_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('education_id');

            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->onDelete('CASCADE');

            $table->foreign('education_id')
                ->references('id')->on('educations')
                ->onDelete('CASCADE');
            $table->unique(['employee_id', 'education_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_employee');
    }
};
