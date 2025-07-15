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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('destination_name')->nullable();
            $table->string('destination_category')->nullable();
            $table->text('destination_card_summary')->nullable();
            $table->boolean('isFavorite')->nullable();
            $table->longtext('highlights')->nullable();
            $table->longtext('visit_time')->nullable();
            $table->longtext('worth_a_visit')->nullable();
            $table->longtext('culture')->nullable();
            $table->longtext('food')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
