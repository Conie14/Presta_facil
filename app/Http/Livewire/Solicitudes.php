<?php

namespace App\Http\Livewire;

use App\Events\SolicitudesEvent;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Solicitude;
use App\Models\User;
use App\Notifications\solicitudesn;
use App\Models\Productossolicitado;
class Solicitudes extends Component
{
    use WithPagination;
    

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $Mensaje, $status, $id_usuario, $id_usuariosolicitante;
    public $updateMode = false;
   
    public function render()
    {

        $keyWord = '%'.$this->keyWord .'%';
        $usuariologeado = auth()->user()->id;
        //$solicitudes=Solicitude::where("id_usuario","=",$usuariologeado)->orderByDesc('id')->get();
        //$users = User::all()->except($usuariologeado);
        //return view('livewire.solicitudes.view',compact('solicitudes','users'));
		
        return view('livewire.solicitudes.view', [
            'solicitudes' => Solicitude::join('users','solicitudes.id_usuario','=','users.id')
                
                        ->select('users.name as name', 'solicitudes.id as id', 'Mensaje','status')
						->orWhere('id_usuariosolicitante', '=', $usuariologeado)
						
						->paginate(10),
            'users' => User::all()->except($usuariologeado),
        ]);
        		
        /*return view('livewire.solicitudes.view', [
            'solicitudes' => Solicitude::latest()

						->orWhere('id_usuario', '=', $usuariologeado)
						
						->paginate(10),
            'users' => User::all(),
        ]);*/
    }
	
    public function cancel()
    {
        $this->resetInput();
        $this->updateMode = false;
    }
	
    private function resetInput()
    {		
		$this->Mensaje = null;
		$this->status = null;
		$this->id_usuario = null;
		$this->id_usuariosolicitante = null;
    }

    public function store()
    {

        $usermanda=auth()->user()->id;
        $name=User::where('id','=', $usermanda)->value('name');
        
        $Solicitude=Solicitude::create([ 
            
			'Mensaje' => $this-> Mensaje,
			'status' =>'P',
			'id_usuario' =>$usermanda,
			'id_usuariosolicitante' => $this-> id_usuariosolicitante,
            'name'=>$name
            //'name'=>Users::where('name','id_usuario','=',$this-> id_usuariosolicitante)
                            
        ]);
        //ESTA LINEA FUNCIONA
       ///auth()->user()->notify(new solicitudesn($Solicitude));

        //NOTIFICACION AL 100------------------------>NO BORRAR
       User::where("id","=",$this-> id_usuariosolicitante)
        
        ->each(function(User $user) use ($Solicitude){
            $user->notify(new solicitudesn($Solicitude));
        });
       //event(new SolicitudesEvent($Solicitude));

        return redirect()->back()->with('message','Tines una solicitud de amistad');
        $this->resetInput();
		
		session()->flash('message', 'Solicitude Successfully created.');
        $this->emit('closeModal');
        //NOTIFICACION AL 100------------------------> NO BORRAR
    }

    public function edit($id)
    {
        $record = Solicitude::findOrFail($id);

        $this->selected_id = $id; 
		//$this->Mensaje = $record-> Mensaje;
		$this->status = $record->status;
		//$this->id_usuario = $record-> id_usuario;
		//$this->id_usuariosolicitante = $record-> id_usuariosolicitante;
		
        //$this->updateMode = true;
    }

    public function update()
    {
        /*$this->validate([
		'Mensaje' => 'required',
		'status' => 'required',
		'id_usuario' => 'required',
		'id_usuariosolicitante' => 'required',
        ]);*/

        if ($this->selected_id) {
			$record = Solicitude::find($this->selected_id);
            $record->update([ 
			//'Mensaje' => $this-> Mensaje,
			'status' => 'A'
			//'id_usuario' => $this-> id_usuario,
			//'id_usuariosolicitante' => $this-> id_usuariosolicitante
            ]);

            //$this->resetInput();
            //$this->updateMode = false;
			session()->flash('message', 'Solicitude Successfully updated.');
        }
    }

    public function destroy($id)
    {
        //echo($id);
        $record=Solicitude::find($id);
        
        //$psolicitado = Productossolicitado::where('id_solicitud', $id)->delete();
        //$psolicitado->delete();
        $record->delete();
        
    }
}
