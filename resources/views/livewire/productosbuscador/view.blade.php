@section('title', __('Productos'))




<div class="container">
    <div class="alert colordark" role="alert">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-1">
                <div class="usuario-white">
                    <b>Buscar productos</b>
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
        
        
        @include('livewire.productosbuscador.vista')
        @include('livewire.productossolicitados.create') 
        @include('livewire.productosbuscador.SendRequestPModal')
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
