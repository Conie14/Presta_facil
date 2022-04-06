<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Municipio;

class Municipios extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.municipios.view', [
            'municipios' => Municipio::latest()
						->orWhere('name', 'LIKE', $keyWord)
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
		$this->name = null;
    }
    protected $messages = [        
        'name.required' => 'El Municipio es requerido',
        'name.min' => 'El Municipio debe ser de minimo de cuatro caracteres',      
        'name.max' => 'El Municipio debe ser de maximo de cuarenta caracteres',
        'name.unique' => 'El Municipio ya se encuentra en la base de datos'        
    ];

    public function store()
    {
        $this->validate([
		    'name' => 'required|string|min:4|max:40|unique:Municipios',
        ]);

        Municipio::create([
			'name' => $this-> name
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'El Municipio se creo correctamente');
    }

    public function edit($id)
    {
        $record = Municipio::findOrFail($id);

        $this->selected_id = $id;
		$this->name = $record-> name;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
		'name' => 'required|string|min:4|max:40|unique:Municipios',
        ]);

        if ($this->selected_id) {
			$record = Municipio::find($this->selected_id);
            $record->update([
			'name' => $this-> name
            ]);

            $this->resetInput();
            $this->emit('closeupdateModal');
            $this->updateMode = false;
			session()->flash('message', 'El Municipio se actualizo correctamente');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Municipio::where('id', $id);
            $record->delete();
            session()->flash('message', 'El Municipio se elimino correctamente');
        }
    }
}
