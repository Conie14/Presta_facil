<div  wire:ignore.self class="modal fade" id="SendRequestModal"  data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="SendRequestModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header mx">
                <h5 class="modal-title" id="exampleModalLabel">Por favor llena los siguientes campos : </h5>
                <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form wire:submit.prevent="sendRequestProduct({{$selected_id}})" method="POST">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <label class="negro"> <strong>Direccion: </strong></label>
                        <br>
                        <input wire:model="direccion" class="form-control" type="text" id="direccion">@error('direccion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="negro"> <strong>Parentesco familiar: </strong></label>                        
                        <br>
                        <input wire:model="parentesco" class="form-control" type="text" id="parentesco">@error('parentesco') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>                
                    <div class="col-md-12">
                        <br>
                        <label class="negro"> <strong>Mensaje de prestamo </strong></label>
                        <br>
                        <input wire:model="telefono" class="form-control" type="text" id="telefono">@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                    <br> <br>
                        <label class="negro"> <strong>Fecha de entrega: </strong></label>
                        <br>
                        <input wire:model="fecha_entrega" class="form-control" type="date"  id="fecha_entrega">@error('fecha_entrega') <span class="error text-danger">{{ $message }}</span> @enderror
                        <br>
                    </div>
                    <div class="col-md-6">
                    <br> <br>
                        <label class="negro"> <strong>Fecha para devolver: </strong></label>
                        <br>
                        <input wire:model="fecha_devolucion" class="form-control" type="date" id="fecha_devolucion">@error('fecha_devolucion') <span class="error text-danger">{{ $message }}</span> @enderror
                        <br>
                    </div>
                     
                </div>               
         
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Solicitar</button>
                </div>
            </form>
                  
            <div wire:loading class="preloader">                        
            </div>
            
        </div>
    </div>
</div>
