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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('country');
            $table->string('city');
            $table->string('ticket_url');
            $table->integer('child_entry_price_from');
            $table->integer('child_entry_price_to');
            $table->integer('adult_entry_price_from');
            $table->integer('adult_entry_price_to');
            $table->text('notes_for_things_to_do');
            $table->string('geo_location');
            $table->string('longitude');
            $table->string('latitude');
            $table->integer('duration_of_the_visit');
            $table->text('description');
            $table->string('featured_image');
            $table->string('owner')->nullable();
            $table->string('source_link')->nullable();
            $table->text('gallery')->nullable();
            $table->text('additional_fields')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
