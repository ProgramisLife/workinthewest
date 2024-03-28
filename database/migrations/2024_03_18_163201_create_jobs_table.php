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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('main_image_path')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('email');
            $table->text('description');
            $table->integer('salary_from')->nullable();
            $table->integer('salary_to')->nullable();
            $table->enum('sex', ['Mężczyzna', 'Kobieta', 'Inne'])->nullable();
            $table->boolean('featured');
            $table->date('expiry');
            $table->date('deadline');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
