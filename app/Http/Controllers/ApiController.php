<?php

namespace App\Http\Controllers;


use App\Models\Municipio;
use App\Models\Producto;
use App\Models\Tiposdeproducto;
use Illuminate\Http\Request;
use App\Models\Usersapis;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Usersapis[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
     */
    public function index($categories)
    {
        //$keyWord = '%'.$categories .'%';
        $ProductFound=Producto::join('tiposdeproductos','productos.id_tiposdeproductos', '=', 'tiposdeproductos.id')
            ->where('clasificacion', $categories)
            ->simplePaginate(15);
        $response=[];
        $aux=0;
        foreach ($ProductFound as $Product){
            $response[$aux++]=[
                'nombre'=>$Product['nombre'],
                'Descripcion'=>$Product['Descripcion'],
                'foto1'=>$Product['foto'],
                'foto2'=>$Product['foto2'],
                'foto3' =>$Product['foto3'],
                'updated_at' =>$Product['updated_at'],
                'EstadoProducto' =>$Product['Estado_actual_del_producto'],
            ];
        }
        return response($response, 200);
    }
    public function findlocation($location)
    {
        //$keyWord = '%'.$categories .'%';
        $ProductFound=Producto::join('users','productos.id_usuario', '=', 'users.id')
            ->join('municipios','users.id_municipio', '=', 'municipios.id')
            ->where('municipios.name', $location)
            ->simplePaginate(15);
        $response=[];
        $aux=0;
        foreach ($ProductFound as $Product){
            $response[$aux++]=[
                'nombre'=>$Product['nombre'],
                'Descripcion'=>$Product['Descripcion'],
                'foto1'=>$Product['foto'],
                'foto2'=>$Product['foto2'],
                'foto3' =>$Product['foto3'],
                'updated_at' =>$Product['updated_at'],
                'EstadoProducto' =>$Product['Estado_actual_del_producto'],
            ];
        }
        return response($response, 200);
    }
    public function categories()
    {
        //[{"clasificacion":"Electronicos"},{"clasificacion":"Cocina"}]
        return Tiposdeproducto::all('clasificacion');
    }
    public function locations()
    {
        //[{"clasificacion":"Electronicos"},{"clasificacion":"Cocina"}]
        return Municipio::all('name');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        return Producto::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Producto::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Usersapis::find($id);
        $product->update($request->all());
        return  $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $page
     * @param  string  $categories
     * @return \Illuminate\Http\Response
     */
    public function search($products)
    {
        //return Producto::where('lastname','like','%'.$products.'%')->get();
        $keyWord = '%'.$products .'%';
        $ProductsFound=Producto::where('nombre', 'LIKE', $keyWord)
            ->orWhere('Descripcion', 'LIKE', $keyWord)
            ->limit(10)
            ->get();
        $response=[];
        $aux=0;
        foreach ($ProductsFound as $Product){
        $response[$aux++]=[
                'nombre'=>$Product['nombre'],
                'Descripcion'=>$Product['Descripcion'],
                'foto1'=>$Product['foto'],
                'foto2'=>$Product['foto2'],
                'foto3' =>$Product['foto3'],
            'updated_at' =>$Product['updated_at'],
            'EstadoProducto' =>$Product['Estado_actual_del_producto'],
        ];
        }
        return response($response, 200);
    }
}
