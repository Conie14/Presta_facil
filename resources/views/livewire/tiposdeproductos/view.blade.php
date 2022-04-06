<div class="container">
	<div class="alert colordark" role="alert">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-1">
				<div class="usuario-white">
					<b>Categorías</b>
				</div>

			</div>
			<div class="col-lg-5 col-md-5 col-sm-1">
				@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
				@endif
			</div>
			<div class="col-lg-2 col-md-2 col-sm-2">
				<div class="usuario-white">
					<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-clipboard"></i> Agregar categorías</button>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		@include('livewire.tiposdeproductos.create')
		@include('livewire.tiposdeproductos.update')
		<table class="table table-hover">
			<thead>
				<tr>
					<td scope="col">#</td>
					<th scope="col">Nombre</th>
					<th scope="col">Accción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tiposdeproductos as $row)
				<tr>
					<td>{{ $loop->iteration }}</td>
					<td>{{ $row->clasificacion }}</td>
					<td>
						<button onclick="confirm('Confirm Delete Tiposdeproducto id {{$row->id}}? \nDeleted Tiposdeproductos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})" class="button-rojo button5"><i class="fas fa-trash-alt"></i></button>
						<button data-toggle="modal" data-target="#updateModal" class="button-verde button5" wire:click="edit({{$row->id}})"><i class="fas fa-pencil-alt"></i></button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>