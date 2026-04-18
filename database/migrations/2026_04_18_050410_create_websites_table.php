<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->id();

            // Foreign Key
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // User Input Fields
            $table->string('business_name');
            $table->string('business_type');
            $table->text('description');

            // AI Generated Fields
            $table->string('title');
            $table->string('tagline');
            $table->text('about');
            $table->json('services');

            $table->timestamps();

            // Index for performance
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('websites');
    }
};
