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
        Schema::create('employeer', function (Blueprint $table) {
            $table->id();
            $table->string('main_image_path')->nullable();
            $table->string('featured_imagepath')->nullable();
            $table->string('background_imagepath')->nullable();
            $table->string('name');
            $table->string('header');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('description')->nullable();
            $table->string('phone');
            $table->string('companywebsite')->nullable();
            $table->date('creation_date');
            $table->enum('company_size', ['Mikro', 'Małe', 'Średnie', 'Duże'])->nullable();
            $table->boolean('featured');

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('linkedin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeer');
    }
};
