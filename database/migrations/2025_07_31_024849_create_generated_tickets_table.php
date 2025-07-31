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
        Schema::create('generated_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_notification_id')->constrained('payment_notifications')->onDelete('cascade'); // Relaciona con la notificación de pago
            $table->string('cedula'); // Para referencia rápida, aunque ya en payment_notifications
            $table->string('ticket_number')->unique(); // El número de ticket generado (único)
            $table->timestamps();

            // Índices opcionales para mejorar el rendimiento de búsqueda
            $table->index('cedula');
            $table->index('ticket_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_tickets');
    }
};
