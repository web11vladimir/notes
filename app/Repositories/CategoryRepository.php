<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
	// получение всех заметок с пагинацией
	public function getAllCategory()
	{
		$columns = [
			'id',
			'name'
		];

		$result = Category::select($columns)
			->orderBy('id', 'ASC')
			->get();

		return $result;
	}
}