<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tiposdeproducto;


class Tiposdeproductos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $clasificacion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tiposdeproductos.view', [
            'tiposdeproductos' => Tiposdeproducto::latest()
						->orWhere('clasificacion', 'LIKE', $keyWord)
						->paginate(10),
        ]);
    }

    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function resetInput()
    {
		$this->clasificacion = null;
       
    }
    protected $messages = [        
            'clasificacion.required' => 'La categoria es requerida',
            'clasificacion.min' => 'La categoria debe ser de minimo de cuatro caracteres',      
            'clasificacion.max' => 'La categoria debe ser de maximo de cuarenta caracteres',
            'clasificacion.unique' => 'La categoria ya se encuentra en la base de datos'       
        ];
    public function store()
    {
        
        $this->validate([
            'clasificacion' => 'required|string|min:4|max:40|unique:tiposdeproductos',
        ]);

        Tiposdeproducto::create([
			'clasificacion' => $this-> clasificacion
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Categoria creada correctamente');
    }

    public function edit($id)
    {

        $record = Tiposdeproducto::findOrFail($id);

        $this->selected_id = $id;
		$this->clasificacion = $record-> clasificacion;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'clasificacion' => 'required|string|min:4|max:40|unique:tiposdeproductos',
        ]);

        if ($this->selected_id) {
			$record = Tiposdeproducto::find($this->selected_id);
            $record->update([
			'clasificacion' => $this-> clasificacion
            ]);

            $this->resetInput();
            $this->updateMode = false;
            $this->emit('closeupdateModal');
			session()->flash('message', 'Se edito correctamente la Categoria');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Tiposdeproducto::where('id', $id);
            $record->delete();
            session()->flash('message', 'Se elimino correctamente la categoria');
        }
    }
}
