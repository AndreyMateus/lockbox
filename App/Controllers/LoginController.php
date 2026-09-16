<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\UserModel;
use Core\Utils\Validation;
use PDO;

use Exception;

class LoginController
{
    public function __invoke()
    {
        return view('login', 'guest');
    }

    public function login()
    {
        $validations = [
            'email' => [
                'filter' => 'email',
                'min' => 8,
                'max' => 75,
            ],
            'password' => [
                'min' => 3,
                'max' => 30
            ]
        ];

        try {
            $validations = Validation::valide($_POST, $validations);

            foreach ($validations as $value) {
                if (is_array($value)) {
                    return view('login', 'guest', $validations);
                }
            }

            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $database = new Database();
            $stmt = $database->query("SELECT 
            id, 
            name, 
            password, 
            email,
            profile_img 
            FROM users 
            WHERE email = :email 
            LIMIT 1", [
                ':email' => $email
            ],  UserModel::class);

            $stmt->setFetchMode(PDO::FETCH_CLASS, UserModel::class);
            $userModel = $stmt->fetch();

            // TODO: adicionar verificação para saber se o e-mail já existe, se já é utilizado no REGISTRO.
            if (!isset($userModel->email) || $userModel->email !== $email || !password_verify($password, $userModel->password)) {
                // TODO: no futuro adicionar um contador de tentativo para bloquear o acesso
                return view('login', 'guest', data: [
                    'login' => [
                        'msg' => 'O Email ou a Senha estão incorretos!',
                    ]
                ]);
            }

            $_SESSION['user'] = $userModel;

            return redirect("/dashboard");
        } catch (Exception $e) {
            view('error', data: [
                // 'Um erro ocorreu ao tentar acessar o sistema!'
                'msg' => $e->getMessage()
            ]);
        }
    }
}
