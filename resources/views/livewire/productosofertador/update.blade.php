<!-- Modal -->
<div wire:ignore.self class="modal fade" id="updateModala" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span wire:click.prevent="cancel()" aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" wire:model="selected_id">

                    <div class="form-group">
                        <label>Nombre del producto <b class="rojo">*</b></label>
                        <br>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label>Descripcion <b class="rojo">*</b></label>
                        <br>
                        <input wire:model="Descripcion" type="text" class="form-control" id="Descripcion" placeholder="Descripcion">@error('Descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="field">
                        <label>Añadir tres imagenes <b class="rojo">*</b></label>
                        <br>
                        <input wire:model="foto" type="file"  id="foto" placeholder="Sube aqui tu foto" multiple accept='image/x-png,image/gif,image/jpg,image/jpeg' />@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

<br>

                    <div class="form-group">
                        <label>Categoria <b class="rojo">*</b></label>
                        <br>
                        <select wire:model='id_tiposdeproductos' class='form-control'>
                            
                            @foreach($tiposdeproductos as $tiposdeproductos)
                                <option value="{{$tiposdeproductos->id}}">{{$tiposdeproductos->clasificacion}} </option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
