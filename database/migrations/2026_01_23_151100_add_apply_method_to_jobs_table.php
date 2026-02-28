<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->string('apply_method')->default('whatsapp')->after('apply_link'); // whatsapp, phone, email, url
            $table->string('apply_value')->nullable()->after('apply_method'); // phone number, email, or URL
        });
    }

    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['apply_method', 'apply_value']);
        });
    }
};
