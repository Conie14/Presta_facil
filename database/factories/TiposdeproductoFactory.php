<?php

namespace Database\Factories;

use App\Models\Tiposdeproducto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TiposdeproductoFactory extends Factory
{
    protected $model = Tiposdeproducto::class;

    public function definition()
    {
        return [
			'clasificacion' => $this->faker->name,
        ];
    }
}
