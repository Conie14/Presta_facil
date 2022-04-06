<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Solicitude</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
				<form>
            <div class="form-group">
                <label for="Mensaje"></label>
                <input wire:model="Mensaje" type="text" class="form-control" id="Mensaje" placeholder="Mensaje">@error('Mensaje') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>



            <div class="form-group">
                <label for="id_usuariosolicitante"></label>
                <select wire:model="id_usuariosolicitante" class='form-control'>
                    <option value="">Usuarios que puede que conoscas</option>
                     @foreach($users as $users)
                    <option value="{{$users->id}}">{{$users->name}} {{$users->lastname}}</option>
                    @endforeach
                </select>
            </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Save</button>
            </div>
        </div>
    </div>
</div>