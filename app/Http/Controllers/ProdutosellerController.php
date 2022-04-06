<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productoseller;
use App\Models\Producto;
use App\Models\User;
use App\Models\Tiposdeproducto;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ProdutosellerController extends Controller
{
    protected $paginationTheme = 'bootstrap';
    public $selected_id, $keyWord, $nombre, $Descripcion,$foto1, $foto2, $foto3, $Estado_actual_del_producto, $id_usuario,$id_tiposdeproductos;
    public $foto;
    public $updateMode = false;
    public $selectedtiposdeproductos=null;
    public $tipos_deproductos=null;
    public $usuario=null;
    use WithPagination;
    use WithFileUploads;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // return view('ofertador');
        //consulta para mostar la lista de produstos ordenados disponibles
        /* $productos=Producto::where("Estado_actual_del_producto","=","D")->orderByDesc('id')->get();
        $keyWord = '%'.$this->keyWord .'%';
        
        return view('livewire.productossellers.index', compact('productos'));
        //return view('livewire.productossellers.index',compact('productos'));*/
    }

    public function indexbuscador(Request $request)
    {
        
        //consulta para mostar la lista de produstos ordenados disponibles
        ///$productos=Producto::where("Estado_actual_del_producto","=","D")->orderByDesc('id')->get();
        //$keyWord = '%'.$this->keyWord .'%';
        
        //return view('livewire.productossellers.indexbuscador', compact('productos'));
        //return view('livewire.productossellers.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        
        //return view('livewire.productossellers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return('hola');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
