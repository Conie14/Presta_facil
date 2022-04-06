<?php

namespace Database\Seeders;

use App\Models\Municipio;
use App\Models\Tiposdeproducto;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('fotos');
        Storage::makeDirectory('fotos');
        // \App\Models\User::factory(10)->create();
        $this->call(RoleAdmin::class);
        Municipio::create(['name'=>"Puebla"]);
        Tiposdeproducto::create(['clasificacion'=>"Electrodomesticos"]);
        User::create([
            'name'=>'admin',
            "lastname"=>"admin",
            "tel"=>"2225102004",
            "email"=>"admin@equipo.com",
            "password"=>Hash::make('admin22'),
            "id_municipio"=>"1"
        ])->assignRole('Admin');
    }
}
