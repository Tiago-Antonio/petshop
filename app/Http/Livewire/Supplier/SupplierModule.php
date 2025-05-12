<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;

class SupplierModule extends Component
{

    //select for delet button
    public $selectedSuppliers = [];

    public function render()
    {
        $suppliers = Supplier::all();

        return view('livewire.supplier.supplierView', [
            'suppliers' => $suppliers,
        ]);
    }

    public function deleteSelectedSuppliers()
    {
        Supplier::whereIn('id', $this->selectedSuppliers)->delete();
        $this->selectedSuppliers = [];
        session()->flash('message', 'Fornecedores apagados!');
    }

}
