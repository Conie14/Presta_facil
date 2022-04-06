<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Municipio extends Model
{
	use HasFactory;
    use HasRoles;
    public $timestamps = true;

    protected $table = 'municipios';

    protected $fillable = ['id','name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productos()
    {
        return $this->hasMany('App\Models\User', 'id_municipio', 'id');
    }

}
