<div class="container">
	<div class="alert colordark" role="alert">
		<div class="row">
			<div class="col-lg-10 col-md-10 col-sm-2">
				<div class="usuario-white">
					<b>Detalles de mis productos prestados</b>						
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				@if (session()->has('message'))
				<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
				@endif
			</div>
		</div>
	</div>
	@include('livewire.detallesdelprestamo.detailsmodal')
	<div class="table-responsive">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Foto</th>
					<th>Fecha Entrega</th>
					<th>Fecha Devolucion</th>
					<th>Nombre Usuario</th>
					<th>Direccion</th>
					<th>Mensaje</th>
					<th>Solicitud</th>
					<th>Parentesco</th>							
					<td>Acciones</td>
				</tr>
			</thead>
			<tbody>
				@foreach($productossolicitados as $row)
				<tr>
					<td width="90"><img class="card-img-top" src="{{ $row->foto }}"></td>
					<td>{{ $row->fecha_entrega }}</td>
					<td>{{ $row->fecha_devolucion }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->direccion }}</td>
					<td>{{ $row->telefono }}</td>
					<td>{{ $row->celular }}</td>
					<td>{{ $row->parentesco }}</td>
					<td>
						<button type="button" wire:click.prevent="acceptRequestLoan({{ $row->productoid }} , {{$row->id}})" class="button-rojo button5">@if( $row->celular==='Pendiente') <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</button>
						
						<button type="button" wire:click.prevent="edit({{ $row->id }})" data-dismiss="modal" data-toggle="modal" data-target="#SendRequestModal" class="button-verde button5" ><i class="fas fa-question-circle"></i></button> 

						<button type="button" class="button-rojo button5" onclick="confirm('Confirm Delete Solicitude id {{$row->id}}? \nDeleted Solicitudes cannot be recovered!')||event.stopImmediatePropagation()" wire:click.prevent="destroy({{ $row->id }})"><i class="fas fa-trash-alt"></i></button>
					</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{ $productossolicitados->links() }}
	</div>
</div>
