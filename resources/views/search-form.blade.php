<form action="/search" method="GET">
	<div class="input-group">
		<input name="q" class="form-control" type="text" value="@if (!empty($query)){{ $query }}@endif">
		<div class="input-group-append">
			<button type="submit" class="form-control input-group-text">Поиск</button>
		</div>
	</div>
</form>	