<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Repositories\NoteRepository;
use App\Repositories\CategoryRepository;
use App\Http\Requests\NoteUpdateRequest;

class NoteController extends Controller
{

    private $noteRepository;

    public function __construct()
    {
        $this->noteRepository = app(NoteRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // id категории из запроса
        $categoryId = $request->input('cat');

        $paginator = $this->noteRepository->getAllWithPaginate(15, $categoryId);
        $categories = $this->categoryRepository->getAllCategory();
        
        return view('index', [
            'notes' => $paginator, 
            'categories' => $categories,
            'categoryId' => $categoryId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->getAllCategory();

        return view('create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteUpdateRequest $request)
    {
        $validatedDate = $request->validated();

        $note = new Note();

        $data = $request->all();

        $result = $note->fill($data)->save();

        if ($result) {
            return back()->with('status', 'Запись добавлена');
        } else {
            return back()->withErrors('Ошибка добавления');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->noteRepository->getNote($id);

        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = $this->noteRepository->getNote($id);

        if (empty($note)) {
            return false;
        }

        $categories = $this->categoryRepository->getAllCategory();

        return view('edit', [
            'note' => $note, 
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteUpdateRequest $request, $id)
    {

        $validatedDate = $request->validated();

        $note = $this->noteRepository->getNote($id);

        $data = $request->all();

        $result = $note->fill($data)->save();

        if ($result) {
            return back()->with('status', 'Успешно обновлено');
        } else {
            return back()->withErrors('Ошибка обновления');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Note::destroy($id);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // метод для вывода заметки во всплывающем окне
    public function showNote($id)
    {
        $note = $this->show($id);
        
        $result = [
            'id' => $note->id,
            'title' => $note->title,
            'desc' => $note->description
        ];

        return json_encode($result);
    }

    // поиск заметок
    public function search(Request $request)
    {
        // поисковый запрос
        $text = $request->query('q');

        // если задан пустой поисковый запрос
        if (empty($text)) {
            return redirect('/')->withErrors('Задан пустой поисковый запрос');
        } else {

            $searchNotes = $this->noteRepository->searchNotes($text);

            return view('search_page', [
                'notes' => $searchNotes, 
                'query' => $text
            ]);
        }
    }
}
