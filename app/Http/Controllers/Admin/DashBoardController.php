<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Tiposdeproducto;
use App\Models\User;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(){
        $UserRegister=User::count();
        $Loans=Producto::where('Estado_actual_del_producto','P')->count();
        return view('Admin.index',[
            "UserRegister"=>$UserRegister,
            "Loans"=>$Loans
        ]);
    }
    //return $user->toJson();
    public function graficdonut(){
        $categories=Tiposdeproducto::pluck('clasificacion');
        //$Produ=Producto::count();
        $resp=[
          "Categoria"=>$categories
        ];
        return $categories;
    }
}
