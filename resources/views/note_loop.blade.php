<ul class="list-group list-group-flush">
	@foreach ($notes as $note)

		<div class="note-item list-group-item">
			<div class="meta-block mb-2">
				<span class="badge badge-primary">{{ $note->category->name }}</span>
				<a href="#" class="badge badge-success edit-note" data-id="{{ $note->id }}">Редактировать</a>
				<a href="#" class="badge badge-danger delete-note" data-id="{{ $note->id }}">Удалить</a>
			</div>
			<a href="#" class="show-note h4" data-id="{{ $note->id }}">{{ $note->title }}</a>
		</div>

	@endforeach
</ul>