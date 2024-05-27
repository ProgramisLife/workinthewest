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
        Schema::create('employee_prize', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('prize_id');

            $table->foreign('employee_id')
                ->references('id')->on('employee')
                ->onDelete('CASCADE');

            $table->foreign('prize_id')
                ->references('id')->on('prizes')
                ->onDelete('CASCADE');
            $table->unique(['employee_id', 'prize_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_prize');
    }
};
