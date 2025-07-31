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
        Schema::table('payment_notifications', function (Blueprint $table) {
            // Añade la columna 'tickets' como JSON, puede ser nullable al principio
            $table->json('tickets')->nullable()->after('number_of_tickets'); // O después de otra columna lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_notifications', function (Blueprint $table) {
            $table->dropColumn('tickets');
        });
    }
};
