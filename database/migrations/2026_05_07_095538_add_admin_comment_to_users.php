<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Adds the column to store admin feedback
            if (!Schema::hasColumn('users', 'admin_comment')) {
                $table->text('admin_comment')->nullable()->after('is_approved');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'admin_comment')) {
                $table->dropColumn('admin_comment');
            }
        });
    }
};