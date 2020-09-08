<div class="category-block text-center mb-4">
	<div class="btn-group">
		<a href="/" class="btn btn-outline-primary @if (!$categoryId) {{ 'active' }} @endif">Все</a>
		@foreach($categories as $category)
			<a href="/?cat={{ $category->id }}" class="btn btn-outline-primary @if ($categoryId == $category->id) {{ 'active' }} @endif">{{ $category->name }}</a>
		@endforeach
	</div>
</div>