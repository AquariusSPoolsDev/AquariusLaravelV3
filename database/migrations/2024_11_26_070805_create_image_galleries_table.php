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
        Schema::create('image_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('image_name');
            $table->text('image_description')->nullable();
            $table->json('image_tags'); // Storing tags as JSON for flexibility
            $table->boolean('is_published');
            $table->foreignId('uploader_id')->constrained('users')->cascadeOnDelete(); // Relationship to users
            $table->timestamps(); // For upload and edit timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_galleries');
    }
};
