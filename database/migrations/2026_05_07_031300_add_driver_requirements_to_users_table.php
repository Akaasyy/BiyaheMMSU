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
        Schema::table('users', function (Blueprint $table) {
            // Check if license_path exists before adding
            if (!Schema::hasColumn('users', 'license_path')) {
                $table->string('license_path')->nullable()->after('password');
            }

            // Check if training_cert_path exists before adding
            if (!Schema::hasColumn('users', 'training_cert_path')) {
                $table->string('training_cert_path')->nullable()->after('license_path');
            }

            // Check if is_approved exists before adding
            if (!Schema::hasColumn('users', 'is_approved')) {
                $table->boolean('is_approved')->default(false)->after('training_cert_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['license_path', 'training_cert_path', 'is_approved']);
        });
    }
};