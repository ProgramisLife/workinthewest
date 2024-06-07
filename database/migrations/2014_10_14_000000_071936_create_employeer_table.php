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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->date('creation_date')->nullable();
            $table->boolean('featured');
            $table->rememberToken();
            $table->string('main_image_path')->nullable();
            $table->string('featured_imagepath')->nullable();
            $table->string('background_imagepath')->nullable();
            $table->string('header')->nullable();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('companywebsite')->nullable();
            $table->enum('company_size', ['Mikro', 'Małe', 'Średnie', 'Duże'])->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('linkedin')->nullable();

            $table
                ->unsignedBigInteger('city_id')->nullable();

            $table->foreign('city_id')
                ->references('id')->on('cities')
                ->onDelete('CASCADE');

            $table
                ->unsignedBigInteger('state_id')->nullable();

            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onDelete('CASCADE');

            $table
                ->unsignedBigInteger('country_id')->nullable();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('CASCADE');
                
            $table->boolean('banned');

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
