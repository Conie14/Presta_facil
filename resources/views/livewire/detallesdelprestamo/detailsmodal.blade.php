<div wire:ignore.self class="modal fade bd-example-modal-lg" id="SendRequestModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="SendRequestModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> <label><strong>Información del usuario</strong></label>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click.prevent="cancel()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table border="0" class="table">
                        <tbody>
                            <tr>
                                <th>Nombre del usuario: </th>
                                <td>{{$nombre}}</td>
                                <th>Número de telefono:</th>
                                <td>{{$telefono}}</td>
                                <th>Parentesco:</th>
                                <td>{{$parentesco}}</td>
                                
                            </tr>
                            <tr>
                                <th>Correo electronico:</th>
                                <td>{{$email}}</td>
                                <th>Mensaje</th>
                                <td>{{$mensaje}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <label><strong>Información del producto</strong></label>
                <br><br>
                <div class="table-responsive">
                    <table border="0" class="table">
                        <tbody>
                            <tr>
                                <th>Nombre del producto: </th>
                                <td>{{$nombreproducto}}</td>
                                <th>Fecha de entrega:</th>
                                <td>{{$fecha_entrega}}</td>
                                <th>Fecha de regreso:</th>
                                <td>{{$fecha_devolucion}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{$fotomodal}}" width="190" height="190">
                                </td>
                                <td>
                                <th>Direccion</th>
                                <td>{{$direccion}}</td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer">
                <button wire:click.prevent="cancel()" type="submit" class="button-rojo button5" data-dismiss="modal">Cancelar</button>
                {{--<button type="button" wire:click.prevent="acceptRequestLoanModal()" class="btn btn-warning" data-dismiss="modal">@if( $row->celular==='Pendiente') Aceptar @else Terminar @endif</button>--}}

            </div>
        </div>
    </div>
</div>
