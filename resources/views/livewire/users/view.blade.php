
<div class="container">
    <div class="alert colordark" role="alert">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-1">
                <div class="usuario-white">
                    <b>Usuarios</b>
                </div>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-1">
                @if (session()->has('message'))
                    <div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
                @endif
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2">
                <div class="usuario-white">
                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-user"> </i> Agregar usuario</button>

                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">

        @include('livewire.users.create')
        @include('livewire.users.actualizar')
        <table class="table table-hover">
            <thead>
            <tr>
                <td scope="col">#</td>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
                <th scope="col">Municipio</th>
                <th scope="col">Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->usersname}}</td>
                    <td>{{ $row->lastname }}</td>
                    <td>{{ $row->tel }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->municipiosname }}</td>
                    <td>
                        <button onclick="confirm('Confirm Delete User id {{$row->id}}? \nDeleted Users cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="button-rojo button5"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" wire:click="edit({{$row->id}})" class="button-verde button5" data-toggle="modal" data-target="#updateModall" ><i class="fas fa-pencil-alt"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


