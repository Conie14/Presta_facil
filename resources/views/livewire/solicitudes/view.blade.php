@section('title', __('Solicitudes'))
<div class="container">
	<div class="alert colordark" role="alert">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="usuario-white">
					<b>Mis solicitudes de amistad y amigos</b>
					<br>
					<b>A = Aceptado</b>
					<b>P = Pendiente</b>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
				@endif
			</div>

		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-hover">
			@include('livewire.solicitudes.create')
			@include('livewire.solicitudes.update')
			<thead>
				<tr>
					<th scope="col">Nombre</th>
					<th scope="col">Mensaje</th>
					<th scope="col">Status</th>
					<th scope="col">ACTIONS</th>
				</tr>
			</thead>
			<tbody>
				@foreach($solicitudes as $row)
				<tr>

					<td>{{ $row->name }}</td>
					<td>{{ $row->Mensaje }}</td>
					<td>{{ $row->status }}</td>
					<td>
						<button type="button" wire:click="edit({{$row->id}})"  wire:click.prevent="update()" class="button-verde button5"><i class="fas fa-check-circle"></i></i></button>
						<button type="button" class="button-rojo button5" onclick="confirm('Confirm Delete Solicitude id {{$row->id}}? \nDeleted Solicitudes cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fas fa-trash-alt"></i></button>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $solicitudes->links() }}
	</div>
</div>