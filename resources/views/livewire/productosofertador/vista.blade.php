<div wire:ignore.self class="modal fade bd-example-modal-lg" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mx">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="rojo" aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100 modalimg" src="{{$foto1}}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 modalimg" src="{{$foto2}}" alt="Second slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100 modalimg" src="{{$foto3}}" alt="Third slide">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only negro">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only negro">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 class="muynegro">Nombre</h3>
                        <h4 class="paraeltitulo"><u>{{ $nombre }}</u></h4>
                        <div class="row">
                            <div class="col-sm">
                                <label class="muynegro"> Categoria </label>
                                <p class="paraeltitulo">{{$id_tiposdeproductos}} </p>
                            </div>
                            <div class="col-sm"></div>
                            <div class="col-sm">
                                <label class="muynegro"> Estado </label>
                                <p class="verduras">@if($Estado_actual_del_producto==='D')
                                    Disponible
                                @else
                                    Prestado
                                @endif </p>
                            </div>
                        </div>
                        <label class="muynegro">Descripcion</label>
                        <p class="paraeltitulo"><u>{{ $Descripcion }}</u></p>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button onclick="confirm('Confirm Delete Tiposdeproducto id {{$selected_id}}? \nDeleted product cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$selected_id}})" class="button-rojo button5"><i class="fas fa-trash-alt"></i></button>
                <a data-toggle="modal" data-dismiss="modal" data-target="#updateModala" class="dropdown-item" wire:click="edit({{$selected_id}})"><i class="fa fa-edit"></i> Edit </a>
            </div>
        </div>
    </div>
</div>