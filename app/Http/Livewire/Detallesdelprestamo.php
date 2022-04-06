<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Productossolicitado;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Detallesdelprestamo extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $id_tiposdeproductos, $fecha_entrega, $fecha_devolucion, $direccion, $telefono, $celular, $parentesco;
	public $nombre, $Descripcion,$foto1, $foto2, $foto3;
	public $updateMode = false;
	public $foto,$fotomodal,$mensaje;
	public $Estado_actual_del_producto,$statusproduct,$nombreproducto,$email;

    public function render()
    {		
		
        return view('livewire.detallesdelprestamo.view', [
            'productossolicitados' => producto::join('productossolicitados','productos.id','=','productossolicitados.id_tiposdeproductos')
						->join('users','productossolicitados.id_usuariosolicitante','=','users.id')	
						->orWhere('productos.id_usuario','=',auth()->user()->id)														
						->select('fecha_entrega','fecha_devolucion','direccion','telefono','celular','parentesco','name',
						'productossolicitados.id','foto','productos.id as productoid','Estado_actual_del_producto')						
						->orderByDesc('productossolicitados.updated_at')
						->paginate(10),
        ]);
		/*return view('livewire.detallesdelprestamo.view', [
            'productossolicitados' => Productossolicitado::latest()
						->orWhere('id_tiposdeproductos', 'LIKE', $keyWord)
						->orWhere('fecha_entrega', 'LIKE', $keyWord)
						->orWhere('fecha_devolucion', 'LIKE', $keyWord)
						->orWhere('direccion', 'LIKE', $keyWord)
						->orWhere('telefono', 'LIKE', $keyWord)
						->orWhere('celular', 'LIKE', $keyWord)
						->orWhere('parentesco', 'LIKE', $keyWord)					
						->paginate(10),
        ]);*/
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->selected_id = null;
		$this->id_tiposdeproductos = null;
		$this->fecha_entrega = null;
		$this->fecha_devolucion = null;
		$this->direccion = null;
		$this->telefono = null;
		$this->mensaje = null;
		$this->celular = null;
		$this->parentesco = null;
		$this->nombre = null;
		$this->nombreproducto = null;
		$this->email = null;
		$this->fotomodal = null;				
    }

    public function store()
    {
        $this->validate([
		'id_tiposdeproductos' => 'required',
		'fecha_entrega' => 'required',
		'fecha_devolucion' => 'required',
		'direccion' => 'required',
		'telefono' => 'required',
		'celular' => 'required',
		'parentesco' => 'required'
        ]);

        Productossolicitado::create([ 
			'id_tiposdeproductos' => $this-> id_tiposdeproductos,
			'fecha_entrega' => $this-> fecha_entrega,
			'fecha_devolucion' => $this-> fecha_devolucion,
			'direccion' => $this-> direccion,
			'telefono' => $this-> telefono,
			'celular' => $this-> celular,
			'parentesco' => $this-> parentesco,			
        ]);
        
        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Productossolicitado Successfully created.');
    }

    public function edit($idproductossolicitados)
    {
        //$record = Productossolicitado::findOrFail($idproductossolicitados);
		$record = producto::join('productossolicitados','productos.id','=','productossolicitados.id_tiposdeproductos')
		->join('users','productossolicitados.id_usuariosolicitante','=','users.id')		
		->select('productossolicitados.id_tiposdeproductos','fecha_entrega','fecha_devolucion',
		'direccion','telefono','celular','parentesco','name','tel','email','nombre','foto')
		->where('productossolicitados.id','=',$idproductossolicitados)		
		->get();
		
        $this->selected_id = $idproductossolicitados; 
		$this->id_tiposdeproductos = $record[0]-> id_tiposdeproductos;
		$this->fecha_entrega = $record[0]-> fecha_entrega;
		$this->fecha_devolucion = $record[0]-> fecha_devolucion;
		$this->direccion = $record[0]-> direccion;
		$this->telefono = $record[0]-> tel;
		$this->mensaje = $record[0]-> telefono;
		$this->celular = $record[0]-> celular;
		$this->parentesco = $record[0]-> parentesco;
		$this->nombre = $record[0]-> name;
		$this->nombreproducto = $record[0]-> nombre;
		$this->email = $record[0]-> email;
		$this->fotomodal = $record[0]-> foto;			   
    }
      
    public function destroy($id)
    {
        if ($id) {
            $record = Productossolicitado::findOrFail($id);
			if(($record->celular)==='Pendiente'){
            	$record->delete();
				session()->flash('message', 'El Producto se elimino correctamente');
			}else{
				session()->flash('message', 'No puedes eliminar aun esta prestado');
			}
        }
    }
	public function acceptRequestLoan($idproduct,$idrequest){
		$record = Producto::findOrFail($idproduct);
		$recordtwo = Productossolicitado::findOrFail($idrequest);
		//celular es estado de la solicitud
		//$record = DB::table('productossolicitados')
		//->join('productos','productossolicitados.id_tiposdeproductos','=','productos.id')
		//->Where('productossolicitados.id','=',$id)															
		//->select('celular','Estado_actual_del_producto')->get();
		$pcolicitado=$recordtwo->celular;
		$this->Estado_actual_del_producto= $record->Estado_actual_del_producto;

		$this->updateMode = true;
		if($this->Estado_actual_del_producto==='D'){
        	$record->update([ 'Estado_actual_del_producto' => 'P']);
        	$recordtwo->update([ 'celular' => 'Aceptado']);
			$this->statusproduct=true;
			session()->flash('message', 'La solicitud ha sido Aceptada');
		}
		else if($this->Estado_actual_del_producto==='P' && $pcolicitado==='Aceptado')
		{
			$record->update([ 'Estado_actual_del_producto' => 'D']);
			$recordtwo->update(['celular'=>'Pendiente']);
			$this->statusproduct=false;
			session()->flash('message', 'Has terminado el prestamo');
		}else{
			session()->flash('message', 'El producto ya se encuentra prestado');
		}
		$this->updateMode = false;       
		$this->resetInput();    	       
	}
	
}
