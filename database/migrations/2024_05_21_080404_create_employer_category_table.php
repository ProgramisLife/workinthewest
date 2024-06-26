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
        Schema::create('employers_category', function (Blueprint $table) {
            $table->unsignedBigInteger('employers_id');
            $table->unsignedBigInteger('jobcategory_id');

            $table->foreign('employers_id')
                ->references('id')->on('employers')
                ->onDelete('CASCADE');

            $table->foreign('jobcategory_id')
                ->references('id')->on('jobcategories')
                ->onDelete('CASCADE');
            $table->unique(['employers_id', 'jobcategory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employer_category', function (Blueprint $table) {
            $table->unique(['employer_id', 'jobcategory_id']);
        });
    }
};
