<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;

class SupplierModule extends Component {
    
    use WithPagination;

    public $name = '';
    public $phone = 8;
    public $email;
    public $address;
    public $created_at;
    public $updated_at;
    public $selectedSuppliers = [];
    public $openModalConfirmDelete = false;
    public $searchSupplierByName;
    public $supplierId = null;

    public $showModalCreateSupplier = false;
    public $showModalDeleteSupplier = false;



    public function render() {

        $suppliers = Supplier::where('name', 'like', '%'.$this->searchSupplierByName.'%')->paginate(10);

        return view('livewire.supplier.supplierView', [
            'suppliers' => $suppliers,
        ]);
    }

    //DELETE FORNECEDOR
    public function deleteSelectedSuppliers() {
        if (empty($this->selectedSuppliers)) {
            session()->flash('error', 'Selecione ao menos um registro!');
            return;
        }

        Supplier::whereIn('id', $this->selectedSuppliers)->delete();
        
        $this->selectedSuppliers = [];
        
        session()->flash('message', 'Fornecedores apagados!');
    }

    //CREATE FORNECEDOR
    public function createSupplier() {

        Supplier::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
        ]);

        session()->flash('success', 'Fornecedor cadastrado com sucesso!');
    }

    //UPDATE FORNECEDOR
    public function updateSupplier($id) {
        
        $supplier = User::findOrFail($id);
        $this->supplierId = $id;
        $this->name = $supplier->name;
        $this->phone = $supplier->phone;
        $this->email = $supplier->email;
        $this->address = $supplier->address;
        
        //$this->show = true;
        //$this->modalAbertoParaId = false;
    }

    //ABRIR MODAL DE CADASTRO DE FORNECEDORES
    public function openModalCreateSupplier() {
        $this->showModalCreateSupplier = true;
    }

    //FECHAR MODAL DE CADASTRO DE FORNECEDORES
    public function closeModalCreateSupplier() {
        $this->resetErrorBag();
        $this->resetarCampos();
        $this->supplierId = null;
        $this->showModalCreateSupplier = false; 
    }

    //FECHAR MODAL DE DELETAR FORNECEDORES
    public function openModalSupplierDelete() {
        $this->showModalDeleteSupplier = true;
    }
    //FECHAR MODAL DE DELETAR FORNECEDORES
    public function closeModalSupplierDelete() {
        $this->showModalDeleteSupplier = false;
    }

}
