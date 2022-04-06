<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productossolicitado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'productossolicitados';

    protected $fillable = ['id_tiposdeproductos','fecha_entrega','fecha_devolucion','direccion','telefono','celular','parentesco','id_usuariosolicitante'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'id_tiposdeproductos');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function solicitude()
    {
        return $this->hasOne('App\Models\Solicitude', 'id');
    }
    
}
