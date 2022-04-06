<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Models\Municipio;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');

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
        'password.max' => 'La contraseña debe ser maximo de 8 caracteres',
        'password_confirmation.required' => 'Debes repetir tu contraseña',
        'password.regex' => 'Debe tener por lo menos 1 minuscula, 1 mayuscula 1 numeros y 1 caracterer especial @#$...',
        'password_confirmation.min' => 'La contraseña debe ser de al menos 8 caracteres',
        'password_confirmation.same' => 'Las contraseñas no son iguales',
        'Muni.required' => 'Debes seleccionar el municipio al que perteneces',
    ];
    
    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required','string','min:3','max:40'],
            'lastname' => ['required','string','min:3','max:51'],
            'tel' => ['required','unique:users','digits:10'],
            'email' => ['required','string','email','unique:users','regex:/(.*)@(live|gmail|yahoo|hotmail|outlook)\.com/i'],
            'password' => ['required','string','min:8','max:40','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
            'password_confirmation'=> ['required','string','min:8','max:40','same:password'],
            'Muni'=>['required','numeric']
        ],$this->messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'id_municipio'=>$data['Muni'],
            'password' => Hash::make($data['password']),
        ])->assignRole('Seller');
    }
}
