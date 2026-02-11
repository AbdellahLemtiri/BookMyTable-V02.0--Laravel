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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('nom_restaurant');
            $table->string('adresse_restaurant');
            $table->string('telephone_restaurant');
            $table->text('description_restaurant')->nullable();
            $table->string('email_restaurant')->nullable();
            $table->integer('capacite_restaurant')->nullable();
            $table->foreignId('type_cuisine_id');
            $table->foreignId('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
