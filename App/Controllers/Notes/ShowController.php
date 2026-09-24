<?php

namespace App\Controllers\Notes;

use Core\Helpers\Session;

class ShowController
{
    public function lock(): void
    {
        Session()->set('visible', false);
        redirect('/notes');
    }
    public function unlock(): void
    {
        Session()->set('visible', true);
        redirect('/notes');
    }
}
