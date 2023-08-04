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
        Schema::create('rumahsakit', function (Blueprint $table) {
            $table->id();
            $table->string('mother_name');
            $table->integer('mother_age');
            $table->string('infant_gender');
            $table->dateTime('infant_birth_datetime');
            $table->integer('gestational_age_weeks');
            $table->decimal('height_cm', 5, 2);
            $table->decimal('weight_kg', 5, 2);
            $table->text('short_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumahsakit');
    }
};
