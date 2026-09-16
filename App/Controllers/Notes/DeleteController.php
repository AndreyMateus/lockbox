<?php

namespace App\Controllers\Notes;

use App\Database\Database;
use Core\Helpers\Request;
use PDOException;

class DeleteController
{
    public function __invoke()
    {
        $noteId = Request::getFieldFormByName('id');
        // TODO: pegar o id do ultima nota e redirecionar

        try {
            $conn = new Database();

            $conn->query("DELETE FROM notes AS n 
            WHERE n.id = :id", [
                ':id' => $noteId
            ]);
        } catch (PDOException $err) {
            // 
        }

        return redirect("/notes");
    }
}
