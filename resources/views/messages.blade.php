@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif

@if ($errors->any())
	@foreach ($errors->all() as $error)
		<div class="alert alert-danger" role="alert">
			{{ $error }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	@endforeach
@endif