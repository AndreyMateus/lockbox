<?php

namespace App\Controllers;

class InfoController
{
    public function __invoke()
    {
        phpinfo();
    }
}
