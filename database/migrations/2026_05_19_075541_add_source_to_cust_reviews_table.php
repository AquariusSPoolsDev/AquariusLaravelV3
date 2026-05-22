<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cust_reviews', function (Blueprint $table) {
            $table->enum('source', ['Manual', 'Google Reviews', 'Facebook'])->default('Manual')->after('is_published');
        });

        DB::table('cust_reviews')
            ->where('reviewer_location', 'Google Reviews')
            ->update(['source' => 'Google Reviews']);
    }

    public function down(): void
    {
        Schema::table('cust_reviews', function (Blueprint $table) {
            $table->dropColumn('source');
        });
    }
};
