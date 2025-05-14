<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;

class SupplierModule extends Component
{
    public $name = '';
    public $phone = 8;
    public $email;
    public $address;
    public $created_at;
    public $updated_at;
    public $selectedSuppliers = [];
    public $openModalConfirmDelete = false;
    public $searchSupplierByName;

    public $show = false;

    public function openModalSupplierDelete() {
        $this->show = true;
    }

    public function closeModalSupplierDelete() {
        $this->show = false;
    }

    public function render()
    {


        $suppliers = Supplier::where('name', 'like', '%'.$this->searchSupplierByName.'%')->paginate(5);

       
        return view('livewire.supplier.supplierView', [
            'suppliers' => $suppliers,
        ]);
    }

    public function deleteSelectedSuppliers()
    {
        // Verificando se algum fornecedor foi selecionado
        if (empty($this->selectedSuppliers)) {
            session()->flash('error', 'Selecione ao menos um registro!');
            return;
        }

        Supplier::whereIn('id', $this->selectedSuppliers)->delete();
        
        $this->selectedSuppliers = [];
        
        session()->flash('message', 'Fornecedores apagados!');
    }


}
