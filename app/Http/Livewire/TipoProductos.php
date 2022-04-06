<?php

namespace App\Http\Livewire;

use App\Models\Tiposdeproducto;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\TipoProducto;

class TipoProductos extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $clasificacion;
    public $updateMode = false;

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.tiposdeproductos.view', [
            'tipoProductos' => Tiposdeproducto::latest()
						->orWhere('clasificacion', 'LIKE', $keyWord)
						->paginate(10),
            ]);
    }

    public function cancel()
    {
        $this->render();
        $this->resetInput();
        $this->updateMode = false;
    }

    private function resetInput()
    {

		$this->clasificacion = null;
    }

    public function store()
    {
        $this->validate([
		    'clasificacion' => 'required|string|min:4|unique:tiposdeproductos',
        ]);

        Tiposdeproducto::create([
			'clasificacion' => $this-> clasificacion
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'TipoProducto Successfully created.');
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
		'clasificacion' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Tiposdeproducto::find($this->selected_id);
            $record->update([

			'clasificacion' => $this-> clasificacion
            ]);

            $this->resetInput();
            $this->emit('closeupdateModal');
            $this->updateMode = false;
			session()->flash('message', 'Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Tiposdeproducto::where('id', $id);
            $record->delete();
        }
    }
}
