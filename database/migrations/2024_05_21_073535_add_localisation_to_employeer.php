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
        Schema::table('employeer', function (Blueprint $table) {
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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employeer', function (Blueprint $table) {
            //
        });
    }
};
