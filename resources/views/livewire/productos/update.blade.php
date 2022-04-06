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
                        <label for="nombre"></label>
                        <input wire:model="nombre" type="text" class="form-control" id="nombre" placeholder="nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group">
                        <label for="Descripcion"></label>
                        <input wire:model="Descripcion" type="text" class="form-control" id="Descripcion" placeholder="Descripcion">@error('Descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="foto"></label>
                        <input wire:model="foto" type="text" class="form-control" id="foto" placeholder="Foto">@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="Estado_actual_del_producto"></label>
                        <select wire:model="Estado_actual_del_producto" class='form-control'>
                            <option value="">Estado del producto</option>
                            <option value="P">Prestado</option>
                            <option value="D">Disponible</option>
                    </div>
                    <div class="form-group">
                        <label for="id_usuario"></label>
                        <select>
                            <option value="">usuario</option>
                            @foreach($users as $users)
                                <option value="{{auth()->user()->id}}">{{auth()->user()->id}} </option>
                            @endforeach
                        </select>

                        <input wire:model="id_usuario" type="text"  value="{{auth()->user()->id}}"  class="form-control" id="id_usuario" placeholder="Id Usuario">@error('id_usuario') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <select wire:model='id_tiposdeproductos' class='form-control'>
                            <option value="">Clasificacion de producto</option>
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
