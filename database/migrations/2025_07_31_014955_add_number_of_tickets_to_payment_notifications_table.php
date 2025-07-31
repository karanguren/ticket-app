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
            // Añade la nueva columna 'number_of_tickets' como entero
            // Puedes hacerla nullable si no todas las notificaciones tendrán tickets,
            // o darle un valor por defecto. En este caso, la hacemos no nula con default 0.
            $table->integer('number_of_tickets')->default(0)->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_notifications', function (Blueprint $table) {
            // Define cómo revertir la migración (eliminar la columna)
            $table->dropColumn('number_of_tickets');
        });
    }
};
