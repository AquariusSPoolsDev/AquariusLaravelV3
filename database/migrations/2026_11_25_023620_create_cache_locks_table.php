<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Adds the table the database cache store keeps its locks in. The 2024 cache migration only
 * created `cache`. Filament 4.17 locks the cache whenever it reads or writes notifications,
 * so without this table every admin page update fails. Additive: the old public site never uses it.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('cache_locks')) {
            return;
        }

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->bigInteger('expiration')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cache_locks');
    }
};
