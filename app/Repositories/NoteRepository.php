<?php
namespace App\Repositories;

use App\Models\Note;
use App\Models\Category;

class NoteRepository
{
	// получение всех заметок с пагинацией
	public function getAllWithPaginate($count, $categoryId)
	{
		$columns = [
			'id',
			'title',
			'category_id'
		];

		$whereSql = ($categoryId) ? 'category_id = ' . $categoryId : 'category_id > 0';

		$result = Note::select($columns)
			->whereRaw($whereSql)
			->orderBy('id', 'DESC')
			->with(['category:id,name'])
			->paginate($count);

		return $result;
	}

	// получение конкретной заметки
	public function getNote($id)
	{
		return Note::find($id);
	}

	// поиск заметок
	public function searchNotes($query)
	{
		$columns = [
            'id',
            'title',
            'category_id'
        ];

        $result = Note::select($columns)
            ->whereRaw('(title LIKE "%' . $query . '%" OR description LIKE "%' . $query . '%")')
            ->orderBy('id', 'DESC')
            ->with(['category:id,name'])
            ->paginate(15);

        return $result;
	}
}