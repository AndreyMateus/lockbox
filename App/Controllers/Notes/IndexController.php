<?php

namespace App\Controllers\Notes;

use App\Models\NoteModel;
use Core\Helpers\Request;

class IndexController
{
    public function index()
    {
        $search = Request::getFieldFormByName('search');

        // todas as notas
        $notes = NoteModel::all($search);

        $id = Request::getFieldFormByName('id');
        settype($id, 'int');

        if (empty($notes)) {
            return view('notes/notfound');
        }

        // nota selecionada para ser exibida
        $selectedNote = $this->getSelectedNoteById($notes, $id);

        return view('notes/index', 'app', data: [
            'notes' => $notes,
            'selectedNote' => $selectedNote,
            'id' => $id
        ]);
    }

    private function getSelectedNoteById(array $notes, int $id)
    {
        // nota selecionada para ser exibida
        $selectedNote = array_find($notes, function ($value, $key) use ($id) {
            if ($value->id === $id) {
                return true;
            }
        }) ?? array_first($notes);

        return $selectedNote;
    }
}
