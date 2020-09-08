// конфиг плагина подсветки кода
hljs.configure({   // optionally configure hljs
    languages: ['javascript', 'php', 'html']
});

// показываем полный текст заметки
$('.note-item a.show-note').on('click', function(e) {
    e.preventDefault();
    var note = $(this);
    var noteId = note.attr('data-id'); // id заметки

    // если заметка уже открыта, то при клике заврываем ее
    var parentNoteBlock = note.parent('.note-item');
    
    if (parentNoteBlock.find('.note-desc').length) {
        parentNoteBlock.find('.note-desc').remove();
    } else {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/ajax/' + noteId,
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(data) {
                // вставляем описание заметки после заголовка
                note.after('<div class="note-desc">' + data.desc + '</div>');

                // добавляем подсветку кода
                document.querySelectorAll('.ql-syntax').forEach((block) => {
                    hljs.highlightBlock(block);
                });
            }
        });
    }	
});

// показываем форму редактирования заметки
$('.edit-note').on('click', function(e) {
    e.preventDefault();

    var note = $(this);
    var noteId = note.attr('data-id'); // id заметки
    var myModal = $('#modalNote');

    $.ajax({
        type: 'GET',
        dataType: 'html',
        url: '/note/' + noteId + '/edit',
        success: function(data) {
            myModal.find('.modal-title').html('Редактирование');
            myModal.find('.modal-body').html(data);

            myModal.modal('show');
        }
    });
});

// показываем форму для создания новой записи
$('.new-note').on('click', function(e) {
    e.preventDefault();

    var myModal = $('#modalNote');

    $.ajax({
        type: 'GET',
        dataType: 'html',
        url: '/note/create',
        success: function(data) {
            myModal.find('.modal-title').html('Новая заметка');
            myModal.find('.modal-body').html(data);

            myModal.modal('show');
        }
    });
});

// удаляем заметку
$('.delete-note').on('click', function(e) {
    e.preventDefault();

    var noteId = $(this).attr('data-id');
    var parentNoteBlock = $(this).closest('.note-item');

    if (confirm('Удалить запись?')) {
        $.ajax({
            type: 'POST',
            url: '/note/' + noteId,
            data: {
                "_token": "{{ csrf_token() }}",
                '_method': 'delete',
                'id': noteId
            },
            success: function(data) {
                parentNoteBlock.remove();
                var removeText = '<div class="alert alert-warning" role="alert">Запись удалена<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>		</button></div>';

                $('.category-block').before(removeText);
            }
        });
    }
});

// очищаем содержимое модального окна при его закрытии
$('#modalNote').on('hidden.bs.modal', function() {
    $(this).find('.modal-title').html('');
    $(this).find('.modal-body').html('');
});