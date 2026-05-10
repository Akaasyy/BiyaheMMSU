<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // This adds the 'jeep_number' column after the 'role' column
            $table->integer('jeep_number')->nullable()->after('role');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // This allows you to "roll back" if you make a mistake
            $table->dropColumn('jeep_number');
        });
    }
};