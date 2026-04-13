<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
{
    // Adding the new column `reviewer_location` which allows NULL
    DB::statement('ALTER TABLE reviews ADD COLUMN reviewer_location VARCHAR(255) NULL AFTER reviewer_name');
}

public function down()
{
    // Reverse the changes made in the up method
    DB::statement('ALTER TABLE reviews DROP COLUMN reviewer_location');
}
};
