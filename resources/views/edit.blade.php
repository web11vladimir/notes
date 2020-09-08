<form action="{{ route('note.update', $note->id) }}" method="POST" class="form-edit">
	@method('PUT')
	@csrf

	<div class="form-group">
		<label for="title">Заголовок</label>
    	<input type="text" class="form-control" name="title" id="title" value="{{ $note->title }}" required>
	</div>

	<div class="form-group">
		<label for="category_id">Категория</label>
    	<select class="form-control" name="category_id" id="category_id">
			@foreach($categories as $category)
				<option value="{{ $category->id }}" @if($note->category_id == $category->id) {{ 'selected' }} @endif>{{ $category->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label for="description">Описание</label>
		<input type="hidden" name="description" id="description">
		<div id="editor"></div>
	</div>

	<button type="submit" class="btn btn-primary">Сохранить</button>
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
</form>

<script>
	var quill = new Quill('#editor', {
		modules: {
			syntax: true, 
			toolbar: [
				['bold', 'link', 'code-block'],
			]
		},
		placeholder: 'Введите текст заметки',
		theme: 'snow'
	});

	var formEdit = document.querySelector('form-edit');

	// set html content
	quill.setHTML = (html) => {
		quill.root.innerHTML = html;
	};

	// get html content
	quill.getHTML = () => {
		return quill.root.innerHTML;
	};

	function decodeHTML (html) {
		var txt = document.createElement('textarea');
		txt.innerHTML = html;
		return txt.value;
	}
	
	var setHTML = `{{ $note->description }}`;

	quill.setHTML(decodeHTML(setHTML));

	quill.on('text-change', () => {
		$('#description').val(quill.getHTML());
	});
</script>