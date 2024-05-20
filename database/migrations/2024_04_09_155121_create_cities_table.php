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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city')->charset('utf8mb4');
            $table->double('longitude');
            $table->double('latitude');
            $table->softDeletes();
            $table->timestamps();

            $table
                ->unsignedBigInteger('state_id');

            $table->foreign('state_id')
                ->references('id')->on('states')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
