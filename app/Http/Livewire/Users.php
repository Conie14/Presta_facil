<?php

namespace App\Http\Livewire;

use Dotenv\Exception\ValidationException;
use http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Municipio;
use App\Models\RegisterController;
use Livewire\Livewire;

class Users extends Component
{
    use WithPagination;

	protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $name, $lastname, $tel, $email,$password,$password_confirmation;
    public $Muni, $cbox2, $MucipioAnterior;
    public $updateMode = false;
    //public $Municipal,$Municipio;

    public function render()
    {

		$keyWord = '%'.$this->keyWord .'%';
        return view('livewire.users.view', [
            'users' => User::join('municipios','users.id_municipio','=','municipios.id')
                        ->select('municipios.name as municipiosname', 'users.name','lastname','tel',
                        'email','users.name as usersname','users.id')
						->orWhere('users.name', 'LIKE', $keyWord)
						->orWhere('lastname', 'LIKE', $keyWord)
						->orWhere('tel', 'LIKE', $keyWord)
						->orWhere('email', 'LIKE', $keyWord)
						->paginate(10),
            'Municipal'=>Municipio::all()
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
		$this->lastname = null;
		$this->tel = null;
		$this->email = null;
        $this->MucipioAnterior=null;
    }

    protected $messages = [        
        'name.required' => 'El Nombre es requerido',
        'name.min' => 'El Nombre es de minimo tres caracteres',
        'name.max' => 'El Nombre es de maximo cincuenta caracteres',
        'lastname.required' => 'El apellido es requerido',
        'lastname.min' => 'El apellido debe ser de minimo de tres caracteres',
        'lastname.max' => 'El apellido debe ser de maximo de cincuenta y uno  caracteres',
        'tel.required' => 'El  telefono es requerido',
        'tel.digits' => 'El  telefono es a diez digitos',
        'tel.unique' => 'El  telefono ya se encuentra registrado',
        'email.required' => 'El  correo es requerido',
        'email.email' => 'El  correo no es valido',
        'email.unique' => 'El  correo ya se encuentra registrado',
        'email.regex' => 'Correo invalido (correos aceptados: live, gmail, yahoo, hotmail, outlook)',
        'password.required' => 'La contraseña es obligatoria',
        'password.min' => 'La contraseña debe ser de al menos 8 caracteres',
        'password.max' => 'La contraseña debe ser maximo de 40 caracteres',
        'password_confirmation.required' => 'Debes repetir tu contraseña',
        'password.regex' => 'Debe tener por lo menos 1 minuscula, 1 mayuscula 1 numeros y 1 caracterer especial @#$...',
        'password_confirmation.min' => 'La contraseña debe ser de al menos 8 caracteres',
        'password_confirmation.same' => 'Las contraseñas no son iguales',
        'Muni.required' => 'Debes seleccionar el municipio al que perteneces',
    ];
    public function store()
    {
        $this->validate([
            'name' => ['required','string','min:3','max:40'],
            'lastname' => ['required','string','min:3','max:51'],
            'tel' => ['required','unique:users','digits:10'],
            'email' => ['required','string','email','unique:users','regex:/(.*)@(live|gmail|yahoo|hotmail|outlook)\.com/i'],
            'password' => ['required','string','min:8','max:40','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            'password_confirmation'=> ['required','string','min:8','max:40','same:password'],
            'Muni'=>['required','numeric']
        ]);

        User::create([
			'name' => $this-> name,
			'lastname' => $this-> lastname,
			'tel' => $this-> tel,
			'email' => $this-> email,
            'password' =>Hash::make( $this-> password),
            'id_municipio' => $this-> Muni
        ])->assignRole('Seller');

        $this->resetInput();
		$this->emit('closeModal');
		session()->flash('message', 'Se ha creado un nuevo Usuario.');
    }


    public function edit($id)
    {
        $record = User::findOrFail($id);
        $this->selected_id = $id;
		$this->name = $record-> name;
		$this->lastname = $record-> lastname;
		$this->tel = $record-> tel;
		$this->email = $record-> email;
        $this->Muni=$record-> id_municipio;
        $this->updateMode = true;
    }



    public function updates()
    {
        $this->validate([
        'name' => ['required','string','min:3','max:40'],
        'lastname' => ['required','string','min:3','max:51'],
        'tel' => ['required','digits:10'],
        'Muni'=>['required','numeric']
        ]);

        $record = User::findOrFail($this->selected_id);
        if($record->email!==$this-> email) {
            $this->validate([
                'email' => ['required','min:10','email','unique:users','regex:/(.*)@(live|gmail|yahoo|hotmail|outlook)\.com/i']
            ]);
        }
        if ($this->selected_id) {
            $record->update([
                'name' => $this->name,
                'lastname' => $this->lastname,
                'tel' => $this->tel,
                'email' => $this->email,
                'id_municipio' => $this-> Muni
            ]);
            $this->resetInput();
            $this->modal = false;
            $this->updateMode = false;
            $this->emit('closeModalUpdate');
            session()->flash('message', 'Usuario editado correctamente');
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = User::where('id', $id);
            $record->delete();
            session()->flash('message', 'Usuario eliminado correctamente');
        }
    }
}
