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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('file_attachment')->nullable(); // Path to PDF file attachment
            $table->foreignId('uploader_id')->constrained('users')->cascadeOnDelete(); // Relationship to users
            $table->timestamps(); // For upload and edit timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
