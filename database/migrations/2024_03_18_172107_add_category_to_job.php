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
        Schema::table('jobs', function (Blueprint $table) {
            $table
                ->unsignedBigInteger('jobcategory_id');

            $table->foreign('jobcategory_id')
                ->references('id')->on('jobcategories')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job', function (Blueprint $table) {
            $table->dropForeign(['jobcategory_id']);
            $table->dropColumn('jobcategory_id');
        });
    }
};
