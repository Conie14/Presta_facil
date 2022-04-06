<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Tiposdeproducto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;
use \Illuminate\Http\Request;
use App\Models\User;
use App\Models\Solicitude;
use App\Notifications\solicitudesn;
use App\Models\Productossolicitado;

class Productosbuscador extends Component
{
	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $Descripcion,$foto1, $foto2, $foto3, $Estado_actual_del_producto, $id_usuario,$id_tiposdeproductos;
    public $foto;
    public $updateMode = false;
    public $selectedtiposdeproductos=null;
    public $tipos_deproductos=null;
    public $usuario=null;
    public $desabilitar=false;
    public $disableform=false;
    public $requestmessage,$colorbutton;
    private $id_usuariosolicitante;
    public $fecha_entrega, $fecha_devolucion, $direccion, $telefono, $celular, $parentesco, $id_solicitud;
    public $testingvar="";
    use WithPagination;
    use WithFileUploads;

    public function upload(){
        //dd('Rad');=

        $validatedData=$this->validate([
            'foto' => 'image|max:1024'
        ]);


        $foto=$this->foto->store('foto','public');
        $validatedData['foto']=$foto;
        Producto::create($validatedData);
        $this->emit('fotosubida');
		session()->flash('message', 'no estoy funcionando');
    }

    public function render()
    {
        //consulta para mostar la lista de produstos ordenados disponibles
        $productos=Producto::join('users','productos.id_usuario','=','users.id')
        ->select('productos.id','nombre','Descripcion','foto','foto2','foto3','Estado_actual_del_producto',)        
        ->where('users.id','!=',auth()->user()->id)
        ->where("Estado_actual_del_producto","=","D")->orderByDesc('productos.id')    
        ->get();
        //$productos=Producto::where("Estado_actual_del_producto","=","D")->orderByDesc('id')->get();
        
        //$keyWord = '%'.$this->keyWord .'%';
        
        //return view('livewire.productossellers.index', compact('productos'));

        return view('livewire.productosbuscador.view',compact('productos'));

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
        $this->selected_id = null;       
        $this->nombre = null;
		$this->Descripcion = null;
		$this->foto = null;
        $this->foto1 = null;
        $this->foto2 = null;
        $this->foto3 = null;
		$this->Estado_actual_del_producto = null;
		$this->id_usuario = null;
        $this->id_tiposdeproductos = null;
        //modal request product data
        $this->fecha_entrega = null;
        $this->fecha_devolucion= null;
        $this->direccion = null;
        $this->telefono = null;
        $this->celular= null; 
        $this->parentesco = null;
        $this->id_solicitud = null;
    }
  
    public function store(Request $request)
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
		session()->flash('message', 'Producto Successfully created.');
    }

    public function edit($id)
    {
        $record = Producto::join('tiposdeproductos','productos.id_tiposdeproductos','=','tiposdeproductos.id')
        ->where('productos.id','=',$id)
        ->get();
        $this->selected_id = $id;
        $this->nombre = $record[0]-> nombre;
		$this->Descripcion = $record[0]-> Descripcion;
		$this->foto1 = $record[0]-> foto;
        $this->foto2 = $record[0]-> foto2;
        $this->foto3 = $record[0]-> foto3;
		$this->Estado_actual_del_producto = $record[0]-> Estado_actual_del_producto;
		$this->id_usuario = $record[0]-> id_usuario;
        $this->id_tiposdeproductos = $record[0]-> clasificacion;
        //$this->desabilitar='disabled="disabled"';
        $this->updateMode = true;
        $usersc = User::join('productos','users.id','=','productos.id_usuario')
        ->join('solicitudes','users.id','=','solicitudes.id_usuariosolicitante')
        ->where('productos.id','=', $id)
        ->where('solicitudes.id_usuario','=', auth()->user()->id);
       
        $estatus=$usersc->value('status');
        if($estatus === 'A'){
            $this->colorbutton='success';
            $this->requestmessage='  Solicitud Aceptada';
            $this->desabilitar=true;
            $this->disableform=false;
        }
        else if($estatus === 'P'){
            $this->colorbutton='primary';
            $this->requestmessage='  Solicitud Pendiente';  
            $this->desabilitar=true; 
            $this->disableform=true;        
        }
        else{
            $this->colorbutton='primary';
            $this->requestmessage='  Enviar Solicitud';
            $this->desabilitar=false; 
            $this->disableform=true;
        }
        
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
    protected $messages = [                
        'fecha_entrega.required' => 'La fecha de entrega es requerida',  
        'fecha_entrega.date' => 'La fecha no tiene el formato correcto',  
        'fecha_entrega.after_or_equal' => 'La fecha de entrega no puede ser antes de hoy', 
        'fecha_entrega.before' => 'La fecha de entrega no puede ser antes que la de devolucion', 
        'fecha_devolucion.required' => 'La fecha de devolucion es requerida',  
        'fecha_devolucion.date' => 'La fecha no tiene el formato correcto', 
        'fecha_devolucion.after' => 'La fecha de prestamo minima es de un dia', 
        'direccion.required' => 'La direccion es obligatoria',
        'direccion.min' => 'La direccion es muy corta',       
        'direccion.max' => 'La direccion es muy larga',             
        'telefono.required' => 'El mensaje de prestamo es requerido',
        'telefono.min' => 'El mensaje de prestamo es muy corto',       
        'telefono.max' => 'El mensaje de prestamo es muy largo',                
        'parentesco.required' => 'El parentescco es requerido', 
        'parentesco.min' => 'El parentescco es muy corto',
        'parentesco.max' => 'El parentescco es muy largo',
    ];  
    protected $rules=[       
        'fecha_entrega' => 'required|date|before:fecha_devolucion|after_or_equal:today',
        'fecha_devolucion' => 'required|date|after:today|after:fecha_entrega',
        'direccion' => 'required|string|min:30|max:80',
        'telefono' => 'required|string|min:30|max:90',      
        'parentesco' => 'required|min:3|max:20'                
    ];
    public function updated($field)
    {
        //el telefono es el mensaje del prestamo, se quedo asi de momento para no modificar la base
        $this->validateOnly($field,$this->rules,$this->messages);
    }    
    public function sendRequestProduct($id)
    {     
        if(!$this->disableform){
            $this->validate();        
            $usermanda=auth()->user()->id;
                Productossolicitado::create([                     
                    'id_tiposdeproductos' => $id,
                    'fecha_entrega' => $this-> fecha_entrega,
                    'fecha_devolucion' => $this-> fecha_devolucion,
                    'direccion' => $this-> direccion,
                    'telefono' => $this-> telefono,
                    'celular' => 'Pendiente',
                    'id_usuariosolicitante' => $usermanda,
                    'parentesco' => $this-> parentesco,
                ]); 
                             
            $this->resetInput();
            $this->emit('closeModalsendRequestProduct');         
        }
        
        //session()->flash('message', 'Productossolicitado Successfully created.');                 
    }

    public function sendFriendRequest($id){
        $id_usuariosolicitante = User::join('productos','users.id','=','productos.id_usuario')            
            ->where('productos.id','=',$id)->value('users.id');    
            //$this->Descripcion=$id_usuariosolicitante;
        
            $usermanda=auth()->user()->id;
            $name=User::where('id','=', $usermanda)->value('name');
            
            $Solicitude=Solicitude::create([                 
                'Mensaje' => 'Hola quiero ser tu amigo@',
                'status' =>'P',
                'id_usuario' =>$usermanda,
                'id_usuariosolicitante' => $id_usuariosolicitante,
                'name'=>$name                               
            ]);
            //ESTA LINEA FUNCIONA
           ///auth()->user()->notify(new solicitudesn($Solicitude));
    
            //NOTIFICACION AL 100------------------------>NO BORRAR
           User::where("id","=",$id_usuariosolicitante)
            
            ->each(function(User $user) use ($Solicitude){
                $user->notify(new solicitudesn($Solicitude));
            });
           //event(new SolicitudesEvent($Solicitude));
            $this->colorbutton='primary';
            $this->requestmessage='  Solicitud Pendiente';
            $this->desabilitar=true;
    
            return redirect()->back()->with('message','Tines una solicitud de amistad');
            //$this->resetInput();            
            //session()->flash('message', 'Solicitude Successfully created.');
            //$this->emit('closeModal');
    }
}
