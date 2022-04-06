<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Tiposdeproducto extends Model
{
	use HasFactory;
    use HasRoles;
    public $timestamps = true;

    protected $table = 'tiposdeproductos';

    protected $fillable = ['clasificacion'];
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'id_producto');
    }
}
