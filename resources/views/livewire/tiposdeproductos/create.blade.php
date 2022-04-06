<!-- Modal -->
<div wire:ignore.self class="modal fade bd-example-modal-lg" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container">
                    <div class="alert colordark" role="alert">
                        <div class="row">
                            <div class="col-lg-9 col-md-6 col-sm-2">
                                <div class="usuario-white">
                                    Agregar Categoría
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-agregarusuario">
                    <div class="form-container">
                        <div class="form-inner">
                            <form class="signup">
                                <label>Ingresa los datos por favor.</label>
                                <div class="field">
                                    <label>Categoría <b class="rojo">*</b></label>
                                    <input wire:model="clasificacion" type="text" id="clasificacion" placeholder="Categoría">@error('clasificacion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- modal-body -->
            <div class="modal-footer">

                <button type="button" wire:click.prevent="cancel()" class="cancelar" data-dismiss="modal">
                    Cancelar
                </button>

                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Agregar Categoria</button>

            </div>
        </div>
    </div>
</div>