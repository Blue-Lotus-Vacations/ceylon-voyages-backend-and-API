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
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();
            $table->string('deal_name')->nullable();
            $table->string('price')->nullable();
            $table->string('no_of_nights')->nullable();
            $table->longText('itinerary_card')->nullable();
            $table->longText('description')->nullable();
            $table->longText('itinerary_description')->nullable();
            $table->longtext('cost_includes_description')->nullable();
            $table->longtext('cost_includes')->nullable();
            $table->longtext('tour_map_description')->nullable();
            $table->longtext('tour_map')->nullable();
            $table->longtext('aditional_information')->nullable();
            $table->boolean('isFavorite')->nullable();
            $table->longtext('hot_deals')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
    }
};
