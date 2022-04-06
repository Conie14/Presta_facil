<?php

namespace App\Http\Livewire;

use Faker\Provider\Image;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Tiposdeproducto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use \Illuminate\Http\Request;
use App\Models\User;
use App\Post;

class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $Descripcion, $foto, $foto2, $foto3, $Estado_actual_del_producto, $id_usuario, $id_tiposdeproductos;
    public $updateMode = false;

    public $selectedtiposdeproductos=null;
    public $tipos_deproductos=null;
    public $usuario=null;
    public $productos=null;

  


    public function upload()
    {
        //dd('Rad');=

        $validatedData = $this->validate([
            'foto' => 'image|max:1024'
        ]);


        $foto = $this->foto->store('foto', 'public');
        $validatedData['foto'] = $foto;
        Producto::create($validatedData);
        $this->emit('fotosubida');
        session()->flash('message', 'no estoy funcionando');
    }
    public function render()
    {
        $keyWord = '%' . $this->keyWord . '%';
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

    private function resetInput()
    {
        $this->nombre = null;

        $this->Descripcion = null;
        $this->foto = null;
        $this->Estado_actual_del_producto = null;
        $this->id_usuario = null;
        $this->id_tiposdeproductos = null;
    }
    public function messages()
    {
        return [
            'foto.min' => 'Sube tres imagenes solamente',
            'foto.max' => 'Sube tres imagenes solamente',
        ];
    }
    public function store()
    {
        //if($request->hasFile('foto')){
        // $path = $request->image->store('public');
        //  Image::create(['path'=>$path]);
        //$product['foto']=$request->file(key:'foto')->store(path:'fotos');
        //}
        $this->validate([
            'nombre' => 'required|min:4',
            'Descripcion' => 'required|min:20',
            'foto.*' => 'image|max:1024',
            'foto' => 'min:3|max:3',
            'Estado_actual_del_producto' => 'required',
            'id_tiposdeproductos' => 'required',


        ]);

        //$namefotos=$this->foto->store('foto','public');
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
            'Estado_actual_del_producto' => $this->Estado_actual_del_producto,
            'foto' => $urlclean[0],
            'foto2' => $urlclean[1],
            'foto3' => $urlclean[2],
            'id_usuario' => auth()->user()->id,
            'id_tiposdeproductos' => $this->id_tiposdeproductos,


        ]);

        $this->resetInput();
        $this->emit('closeModal');
        session()->flash('message', 'Producto agregado.');
    }

    public function edit($id)
    {
        $record = Producto::findOrFail($id);

        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->Descripcion = $record->Descripcion;
        $this->foto = $record->foto;
        $this->Estado_actual_del_producto = $record->Estado_actual_del_producto;
        $this->id_usuario = $record->id_usuario;
        $this->id_tiposdeproductos = $record->id_tiposdeproductos;
        $this->updateMode = true;
    }
    public function modal($id)
    {
        $record = Producto::findOrFail($id);

        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->Descripcion = $record->Descripcion;
        //$this->foto = $record-> foto;

        $this->Estado_actual_del_producto = $record->Estado_actual_del_producto;
        $this->id_usuario = $record->id_usuario;
        $this->id_tiposdeproductos = $record->id_tiposdeproductos;
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
                'nombre' => $this->nombre,
                'Descripcion' => $this->Descripcion,
                'foto' => $this->foto,
                'Estado_actual_del_producto' => $this->Estado_actual_del_producto,
                'id_usuario' => $this->id_usuario,
                'id_tiposdeproductos' => $this->id_tiposdeproductos,

            ]);

            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Producto Successfully updated.');
        }
    }

    public function disponibles(){
       // $pdisponible=DB::table('productos')->where('Estado_actual_del_producto','=','D')->get();

       // return view('Productos.productos.productosdisponible',[
        //   'posts'=>Posts::orderBy('id','desc')->paginate(8)]);
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Producto::where('id', $id);
            $record->delete();
        }
    }
    public function eliminar()
    {
        if ($this->selected_id) {
            $record = Producto::find($this->selected_id);
            $record->delete();
        }
    }
}
