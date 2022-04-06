<?php

namespace Database\Factories;

use App\Models\Solicitude;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SolicitudeFactory extends Factory
{
    protected $model = Solicitude::class;

    public function definition()
    {
        return [
			'Mensaje' => $this->faker->name,
			'status' => $this->faker->name,
			'id_usuario' => $this->faker->name,
			'id_usuariosolicitante' => $this->faker->name,
        ];
    }
}
