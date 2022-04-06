<?php

namespace Database\Factories;

use App\Models\Productossolicitado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductossolicitadoFactory extends Factory
{
    protected $model = Productossolicitado::class;

    public function definition()
    {
        return [
			'id_tiposdeproductos' => $this->faker->name,
			'fecha_entrega' => $this->faker->name,
			'fecha_devolucion' => $this->faker->name,
			'direccion' => $this->faker->name,
			'telefono' => $this->faker->name,
			'celular' => $this->faker->name,
			'parentesco' => $this->faker->name,
			'id_solicitud' => $this->faker->name,
        ];
    }
}
