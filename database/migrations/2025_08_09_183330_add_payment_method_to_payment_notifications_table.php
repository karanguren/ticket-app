<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('payment_notifications', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('capture_path');
        });
    }

    public function down(): void
    {
        Schema::table('payment_notifications', function (Blueprint $table) {
            $table->dropColumn('payment_method');
        });
    }
};
