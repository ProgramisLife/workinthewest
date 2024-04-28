<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * 
     * Accommodation Model
     * 
     * @property int $id
     * @property int $ownerid
     * @property string $mainimagepath
     * @property string $title (min:3|max:255) tytuł
     * @property text $description
     * @property string $email
     * @property string $phone_number
     * @property int $price
     * @property enum $sold {do kupienia, wynajem}
     * @property string $slug   (max:255|unique)
     * @property bool $featured {Czy jest wyróżnione: Tak Nie}
     * @property string $contact {Osoba kontaktowa / Nazwa firmy} required
     */

    /**
     * Date Job Model
     * @property date $expiry {Data wygaśnięcia ogłoszenia: Ogłoszenie nie aktualne}
     */
    public function up(): void
    {
        Schema::create('accommodation', function (Blueprint $table) {
            $table->id();
            $table
                ->unsignedBigInteger('owner_id')->nullable();

            $table->foreign('owner_id')
                ->references('id')->on('users')
                ->onDelete('CASCADE');

            $table->string('title');
            $table->text('description');
            $table->string('email');
            $table->string('contact');
            $table->string('main_image_path')->nullable();
            $table->string('phone_number')->nullable();
            $table->integer('price_buy')->nullable();
            $table->integer('price_rent')->nullable();
            $table->string('slug')->unique();
            $table->boolean('featured');

            $table->date('expiry');

            $table
                ->unsignedBigInteger('currencies_id');

            $table->foreign('currencies_id')
                ->references('id')->on('currencies')
                ->onDelete('CASCADE');

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

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation');
    }
};
