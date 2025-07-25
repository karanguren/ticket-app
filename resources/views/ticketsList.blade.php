@extends('layouts.app') {{-- Asume que tienes un layout principal --}}

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Lista de Mis Ítems</h1>

        {{-- Aquí se renderiza tu componente Livewire. ¡Así de simple! --}}
        @livewire('item-list')

    </div>
@endsection