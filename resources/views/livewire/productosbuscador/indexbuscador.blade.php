@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="es">
    
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos disponibles Buscador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <div class="alert colordark" role="alert">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-1">
                    <div class="usuario-white">
                        <b>Productos</b>
                    </div>
    
                </div>
                <div class="col-lg-5 col-md-5 col-sm-1">
                    @if (session()->has('message'))
                    <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                    @endif
                </div>
 
            </div>
        </div>
    
    
        <div class="container contenedor">
           
            @include('livewire.productos.vista')
    
            <center>
                <div class="row">
                    @foreach($productos as $row)
                    <div class="col-lg-4 col-md-6 col-sm-12 mx-auto">
                        <div class="card cards" style="width: 18rem;">
                            <img class="card-img-top" src="{{ $row->foto }}">
                            <div class="card-body contenido">
                                <h5 data-toggle="modal" data-target="#updateModal" wire:click="edit({{$row->id}})" class="card-title">{{ $row->nombre }}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </center>
        </div>
    
    </div>
    
</body>
</html>
@endsection