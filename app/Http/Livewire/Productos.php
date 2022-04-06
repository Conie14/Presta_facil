<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Tiposdeproducto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use \Illuminate\Http\Request;
use App\Models\User;

class Productos extends Component
{
	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $Descripcion,$foto1, $foto2, $foto3, $Estado_actual_del_producto, $id_usuario,$id_tiposdeproductos;
    public $foto=[3];
    public $updateMode = false;
    public $selectedtiposdeproductos=null;
    public $tipos_deproductos=null;
    public $usuario=null;
    use WithPagination;
    use WithFileUploads;

    /*public function upload(){
        //dd('Rad');=

        $validatedData=$this->validate([
            'foto' => 'image|max:1024'
        ]);


        //$foto=$this->foto->store('foto','public');
        //$validatedData['foto']=$foto;
        Producto::create($validatedData);
        $this->emit('fotosubida');
		session()->flash('message', 'no estoy funcionando');
    }*/

    public function render()
    {
		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.productos.view', [
            'productos' => Producto::latest()
                        ->orWhere('nombre', 'LIKE', $keyWord)

						->orWhere('Descripcion', 'LIKE', $keyWord)
						->orWhere('foto', 'LIKE', $keyWord)
						->orWhere('Estado_actual_del_producto', 'LIKE', $keyWord)
						->orWhere('id_usuario', 'LIKE', $keyWord)
                        ->orWhere('id_tiposdeproductos', 'LIKE', $keyWord)
						->paginate(10),
            'tiposdeproductos' => Tiposdeproducto::all(),
            'users' => User::all()
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
        $this->nombre = null;
		$this->Descripcion = null;
		$this->foto = [];
        $this->foto1 = null;
        $this->foto2 = null;
        $this->foto3 = null;
		$this->Estado_actual_del_producto = null;
		$this->id_usuario = null;
        $this->id_tiposdeproductos = null;
    }
    protected $messages = [        
        'nombre.required' => 'El Nombre es requerido',
        'nombre.min' => 'El Nombre debe ser de minimo cuatro caracteres',
        'nombre.max' => 'El Nombre debe ser de maximo veinte caracteres',
        'Descripcion.required' => 'La descripcion es requerida',
        'Descripcion.min' => 'La descripcion es de minimo veinte caracteres',
        'Descripcion.max' => 'La descripcion es de maximo cien caracteres',
        'foto.min' => 'Debes subir tres fotos',
        'foto.max' => 'Debes subir solo tres fotos',
        'foto.image' => 'Solo se aceptan fotos',
        'id_tiposdeproductos.required' => 'Debes seleccionar una categoria',
    ];

    public function store(Request $request)
    {
        //if($request->hasFile('foto')){
           // $path = $request->image->store('public');
          //  Image::create(['path'=>$path]);
            //$product['foto']=$request->file(key:'foto')->store(path:'fotos');
        //}
        $this->validate([
            'nombre' => 'required|min:4|max:20',
            'Descripcion' => 'required|min:20|max:100',
            'foto.*' => 'image|max:4096',
            'foto' => 'min:3|max:3',            
            'id_tiposdeproductos' => 'required|digits:1',
        ]);

        $urlclean = [];
        $inde = 0;
        foreach ($this->foto as $fotoname) {
            $namefoto = $fotoname->store('foto', 'public');
            $urlclean[$inde++] = Storage::url($namefoto);
        }
        //$urlclean=Storage::url($namefoto);
        Producto::create([
            'nombre' => $this->nombre,
            'Descripcion' => $this->Descripcion,
            'Estado_actual_del_producto' => 'D',
            'foto' => $urlclean[0],
            'foto2' => $urlclean[1],
            'foto3' => $urlclean[2],
            'id_usuario' => auth()->user()->id,
            'id_tiposdeproductos' => $this->id_tiposdeproductos,
        ]);

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Producto Successfully created.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);

        $this->selected_id = $id;
        $this->nombre = $record-> nombre;
		$this->Descripcion = $record-> Descripcion;
		$this->foto1 = $record-> foto;
        $this->foto2 = $record-> foto2;
        $this->foto3 = $record-> foto3;
		$this->Estado_actual_del_producto = $record-> Estado_actual_del_producto;
		$this->id_usuario = $record-> id_usuario;
        $this->id_tiposdeproductos = $record-> id_tiposdeproductos;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
        'nombre' => 'required',
		'Descripcion' => 'required',
		'foto' => 'required',
		'Estado_actual_del_producto' => 'required',
		'id_usuario' => 'required',
        'id_tiposdeproductos' => 'required',
        ]);

        if ($this->selected_id) {
			$record = Producto::find($this->selected_id);
            $record->update([
            'nombre' => $this-> nombre,
			'Descripcion' => $this-> Descripcion,
			'foto' => $this-> foto,
			'Estado_actual_del_producto' => $this-> Estado_actual_del_producto,
			'id_usuario' => $this-> id_usuario,
            'id_tiposdeproductos' => $this-> id_tiposdeproductos,
            ]);

            $this->resetInput();
            $this->updateMode = false;
			session()->flash('message', 'Producto Successfully updated.');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Producto::where('id', $id);
            if($record!=null){
            Storage::delete([
                Str::replaceArray("storage",["public"],$this->foto1),
                Str::replaceArray("storage",["public"],$this->foto2),
                Str::replaceArray("storage",["public"],$this->foto3)]);
            $record->delete();
            $this->emit('closeupdateModal');
            }
        }
    }
}
