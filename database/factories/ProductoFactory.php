<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
			'Descripcion' => $this->faker->name,
			'foto' =>  $this->faker->name,
            'foto2' =>  $this->faker->name,
            'foto3' =>  $this->faker->name,
			'Estado_actual_del_producto' => $this->faker->name,
			'id_usuario' => $this->faker->name,
            'id_tiposdeproductos' => $this->faker->name,
        ];
    }
}
