<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Note extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'title',
		'category_id',
		'description'
	];

    // категория заметки
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
}
