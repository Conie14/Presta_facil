
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
                                    Agregar usuario
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-agregarusuario">
                    <div class="form-container">
                        <div class="form-inner">
                            <form class="signup" autocomplete="off">
                                <label>Ingresa los datos por favor.</label>
                                <div class="field">
                                    <label>Nombre <b class="rojo">*</b></label>
                                    <input wire:model="name" type="text" id="name" placeholder="Name">@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="field">
                                    <label>Apellidos <b class="rojo">*</b></label>
                                    <input wire:model="lastname" type="text" id="lastname" placeholder="Lastname">@error('lastname') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="field">
                                    <label>Teléfono <b class="rojo">*</b></label>
                                    <input wire:model="tel" type="text" id="tel" placeholder="Tel">@error('tel') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="field"><br>
                                    <label>Correo electrónico <b class="rojo">*</b></label>
                                    <input wire:model="email" type="email" id="email" placeholder="Email" autocomplete="off">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div><br>
                                <div class="field">
                                    <label>Municipio <b class="rojo">*</b></label>
                                    <br>
                                    <select wire:model="Muni" >
                                        <option value=""></option>
                                        @foreach($Municipal as $Municipio)
                                            <option value="{{$Municipio->id}}">{{$Municipio->name}}</option>
                                        @endforeach
                                    </select><br>@error('Muni') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="field">
                                    <label>Contraseña <b class="rojo">*</b></label>
                                    <input wire:model="password" type="password" id="password" placeholder="Password">@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="field">
                                <br>
                                    <label>Confirmar contraseña <b class="rojo">*</b></label>
                                    <input wire:model="password_confirmation" type="password" id="password_confirmation" placeholder="Password Confirmation">@error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
                                    
                                </div><br> <br>
                            </form>
                        </div>
                    </div>
                </div>

            </div> <!-- modal-body -->
            <div class="modal-footer">

                <button type="button" wire:click.prevent="cancel()" class="cancelar" data-dismiss="modal">
                    Cancelar
                </button>

                <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">Agregar usuario</button>

            </div>
        </div>
    </div>
</div>
