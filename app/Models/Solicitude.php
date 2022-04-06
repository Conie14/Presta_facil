<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'solicitudes';

    protected $fillable = ['Mensaje','status','id_usuario','id_usuariosolicitante','name'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productossolicitados()
    {
        return $this->hasMany('App\Models\Productossolicitado', 'id_solicitud', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_usuario');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user1()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_usuariosolicitante');
    }
    
}
