<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cedula');
            $table->string('phone');
            $table->string('email');
            $table->string('reference_number', 4); // Para los últimos 4 dígitos de la referencia
            $table->string('capture_path')->nullable(); // Ruta de la imagen, puede ser nula
            $table->decimal('amount', 10, 2); // Monto total
            $table->boolean('is_confirmed')->default(false); // Para el estado de confirmación
            $table->timestamp('confirmed_at')->nullable(); // Fecha de confirmación
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_notifications');
    }
};
