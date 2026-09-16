<?php

namespace App\Controllers;

use App\Models\NoteModel;

class DashboardController
{
    public function __invoke()
    {
        $qtdTotalNotes =  NoteModel::sumAllNotes();
        $qtdTotalNotesToday =  NoteModel::sumAllNotesToday();

        return view('dashboard', 'app', [
            'qtd_total_notes' => $qtdTotalNotes,
            'qtd_total_notes_today' => $qtdTotalNotesToday
        ]);
    }
}
