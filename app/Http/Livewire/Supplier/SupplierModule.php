<?php

namespace App\Http\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\WithPagination;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Spatie\Browsershot\Browsershot;

#[Title('Fornecedores')]
class SupplierModule extends Component
{
    use WithPagination;

    //URL query parameters
    #[Url(as: 'q', history: true)]
    public $searchSupplierByName;

    public $name = '';
    public $phone;
    public $email;
    public $address;
    public $created_at;
    public $updated_at;
    public $selectedSuppliers = [];
    public $openModalConfirmDelete = false;

    public $supplierId = null;
    public $showModalCreateSupplier = false;
    public $showModalDeleteSupplier = false;
    public $showModalUpdateSupplier = false;
    public $showModalGraphic = false;
    public $showChart = false;

    public function updatedsearchSupplierByName()
    {
        $this->resetPage();
    }

    public function nextPage()
    {
        $pageName = 'page';
        $paginaAtual = $this->getPage($pageName);

        $ultimaPagina = Supplier::where('name', 'like', '%' . $this->searchSupplierByName . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->lastPage();

        if ($paginaAtual < $ultimaPagina) {
            $this->setPage($paginaAtual + 1, $pageName);
        }
    }

    public function render()
    {
        $suppliers = Supplier::where('active', 1)
            ->where('name', 'like', '%' . $this->searchSupplierByName . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $suppliersWithDeliveries = Supplier::select('suppliers.name', DB::raw('COUNT(stock_entries.id) as total_entregas'))->leftJoin('stock_entries', 'suppliers.id', '=', 'stock_entries.supplier_id')->groupBy('suppliers.id', 'suppliers.name')->orderBy('total_entregas', 'desc')->take(15)->get();

        return view('livewire.supplier.supplierView', [
            'suppliers' => $suppliers,
            'suppliersWithDeliveries' => $suppliersWithDeliveries,
            'lastPage' => $suppliers->lastPage(),
        ]);
    }

    public function generateRelatoryPDF()
    {
        try {
            $suppliers = Supplier::all();

            $html = view('pdf.supplierRelatory', compact('suppliers'))->render();

            $fileName = 'fornecedores.pdf';

            Browsershot::html($html)
                ->setOption('args', ['--no-sandbox'])
                ->save(storage_path("app/public/{$fileName}"));

            return response()->download(storage_path("app/public/{$fileName}"));
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao gerar o PDF: ' . $e->getMessage());
        }
    }

    //DELETE FORNECEDOR
    public function deleteSelectedSuppliers()
    {
        if (empty($this->selectedSuppliers)) {
            session()->flash('error', 'Selecione ao menos um registro!');
            return;
        }

        Supplier::whereIn('id', $this->selectedSuppliers)->update(['active' => false]);

        $this->selectedSuppliers = [];

        session()->flash('message', 'Fornecedores desativados!');

        $this->showModalDeleteSupplier = false;
    }

    //CRUD - CREATE
    public function createSupplier()
    {
        // VALIDACAO
        $validatedData = $this->validate([
            'name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|unique:suppliers,email',
            'address' => 'nullable|string|max:255',
        ]);

        try {
            Supplier::create($validatedData);

            session()->flash('success', 'Fornecedor cadastrado com sucesso!');
            $this->showModalCreateSupplier = false;

            // Opcional: limpa os campos do formulário
            $this->reset(['name', 'phone', 'email', 'address']);
        } catch (\Throwable $e) {
            session()->flash('error', 'Erro ao cadastrar fornecedor. Tente novamente.');
            \Log::error('Erro ao cadastrar fornecedor: ' . $e->getMessage());
        }
    }

    //CRUD - BRING DATA
    public function bringInfoSupplier($id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            $this->supplierId = $supplier->id;
            $this->name = $supplier->name;
            $this->phone = $supplier->phone;
            $this->email = $supplier->email;
            $this->address = $supplier->address;

            $this->showModalUpdateSupplier = true;
        } catch (\Throwable $e) {
            session()->flash('error', 'Erro ao carregar dados do fornecedor.');
            \Log::error('Erro ao carregar fornecedor ID ' . $id . ': ' . $e->getMessage());
        }
    }

    //CRUD - UPDATE
    public function updateSupplier()
    {
        try {
            $supplier = Supplier::findOrFail($this->supplierId);

            $validatedData = $this->validate([
                'name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
                'address' => 'nullable|string|max:255',
            ]);

            $supplier->update($validatedData);

            session()->flash('success', 'Fornecedor atualizado com sucesso!');
            $this->showModalUpdateSupplier = false;

            $this->reset(['name', 'phone', 'email', 'address', 'supplierId']);
        } catch (\Throwable $e) {
            session()->flash('error', 'Erro ao atualizar fornecedor. Tente novamente.');
            \Log::error('Erro ao atualizar fornecedor: ' . $e->getMessage());
        }
    }

    //OPEN CREATE MODAL
    public function openModalCreateSupplier()
    {
        $this->reset(['supplierId', 'name', 'phone', 'email', 'address']);
        $this->showModalCreateSupplier = true;
    }

    //CLOSE CREATE MODAL
    public function closeModalCreateSupplier()
    {
        //$this->resetErrorBag();
        //$this->resetarCampos();
        $this->supplierId = null;
        $this->showModalCreateSupplier = false;
    }

    //OPEN DELETE MODAL
    public function openModalSupplierDelete()
    {
        $this->showModalDeleteSupplier = true;
    }
    //CLOSE DELETE MODAL
    public function closeModalSupplierDelete()
    {
        $this->showModalDeleteSupplier = false;
    }

    //OPEN UPDATE MODAL
    public function openModalUpdateSupplier()
    {
        $this->showModalUpdateSupplier = true;
    }
    //CLOSE UPDATE MODAL
    public function closeModalUpdateSupplier()
    {
        $this->showModalUpdateSupplier = false;
    }

    //OPEN GRAPHIC MODAL
    public function openModalGraphic()
    {
        $this->showModalGraphic = true;
    }
    //CLOSE GRAPHIC MODAL
    public function closeModalGraphic()
    {
        $this->showModalGraphic = false;
    }
}
