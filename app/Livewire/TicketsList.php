<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item; // Asegúrate de importar tu modelo Item
use Livewire\WithPagination; // Importa el trait WithPagination para la paginación

class TicketsList extends Component
{
    use WithPagination; // Habilita la paginación en el componente

    public $search = ''; // Propiedad para el término de búsqueda
    public $perPage = 10; // Propiedad para la cantidad de ítems por página
    public $sortField = 'created_at'; // Campo por el que se ordenará inicialmente
    public $sortDirection = 'desc'; // Dirección de la ordenación inicial ('asc' o 'desc')

    /**
     * Hook de Livewire que se ejecuta antes de que la propiedad $search se actualice.
     * Sirve para resetear la paginación a la primera página cuando cambia el término de búsqueda.
     */
    public function updatingSearch()
    {
        $this->resetPage(); // Resetea la paginación
    }

    /**
     * Método para cambiar el campo y la dirección de ordenación.
     * @param string $field El nombre del campo por el que se desea ordenar.
     */
    public function sortBy($field)
    {
        // Si el campo de ordenación es el mismo, invertimos la dirección
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // Si es un nuevo campo, lo establecemos y la dirección por defecto es ascendente
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field; // Actualiza el campo de ordenación
    }

    /**
     * El método render se encarga de construir la consulta de datos y pasarla a la vista.
     * Se ejecuta automáticamente cada vez que Livewire detecta un cambio en las propiedades reactivas.
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $items = Item::query()
            // Si hay un término de búsqueda, aplica el filtro por el campo 'name'
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            // Aplica la ordenación según el campo y la dirección definidos
            ->orderBy($this->sortField, $this->sortDirection)
            // Pagina los resultados según la cantidad de ítems por página
            ->paginate($this->perPage);

        return view('livewire.item-list', [
            'items' => $items, // Pasa los ítems paginados a la vista
        ]);
    }
}
