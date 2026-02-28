<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('user_id');
            $table->string('company_logo')->nullable()->after('company_name');
            $table->string('job_role')->nullable()->after('category_id');
            $table->string('qualification')->nullable()->after('experience');

            // Contact Details
            $table->string('primary_country_code')->default('+965')->after('apply_value');
            $table->string('primary_mobile')->nullable()->after('primary_country_code');
            $table->string('alternate_country_code')->nullable()->after('primary_mobile');
            $table->string('alternate_mobile')->nullable()->after('alternate_country_code');
            $table->string('contact_email')->nullable()->after('alternate_mobile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'company_name',
                'company_logo',
                'job_role',
                'qualification',
                'primary_country_code',
                'primary_mobile',
                'alternate_country_code',
                'alternate_mobile',
                'contact_email'
            ]);
        });
    }
};
