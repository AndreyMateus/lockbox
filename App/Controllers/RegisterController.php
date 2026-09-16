<?php

namespace App\Controllers;

use Core\Utils\Validation;
use App\Database\Database;
use finfo;
use Exception;

class RegisterController
{
    public function __invoke()
    {
        view('register', 'guest');
        return $this;
    }

    public function register()
    {
        try {
            $errorsValidation = [
                'name' => [
                    'min' => 4,
                    'max' => 50
                ],
                'email' => [
                    'filter' => 'email'
                ],
                'password' => [
                    'min' => 4,
                    'max' => 50,
                    'especials' => 1
                ],
                'confirm' => [
                    'confirm' => $_POST["password"]
                ]
            ];

            Validation::valide($_POST, $errorsValidation);

            $resultValidations = [];

            // catch the fails validations of form
            foreach (Validation::$errors as $error) {
                if (is_array($error)) {
                    $resultValidations[$error['fieldName']] = $error;
                }
            }

            if (!empty($resultValidations)) {
                return view('register', 'app', $resultValidations);
            }

            $name = $_POST["name"] ?? '';
            $password = $_POST["password"] ?? '';
            $email = $_POST["email"] ?? '';

            $profile_image = $_FILES['profile_image'];

            if (!empty($profile_image['name'])) {
                $pathToSaveProfileImg = convert_separator_of_path(base_path("Public\\uploads\\profile_images\\") . uniqid() . $profile_image['name']);

                $f =  new finfo();
                $mimetypeOfSendFile = $f->file($profile_image['tmp_name'], FILEINFO_MIME_TYPE);

                $whitelist = ["image/png", "image/jpeg", "image/jpg"];
                if (!in_array($mimetypeOfSendFile, $whitelist)) {
                    // TODO: substituir essa exception por um erro/aviso visual para o usuario!
                    throw new Exception("Tipo de imagem inválido!");
                }
            }

            // password hash
            $password = password_hash($password, PASSWORD_DEFAULT);

            $database = new Database();

            $database->query("
            INSERT INTO users (name, password, email, profile_img) 
            VALUES (:name,:password,:email,:profile_img)", [
                ':name' => $name,
                ':password' => $password,
                ':email' => $email,
                ':profile_img' => $pathToSaveProfileImg ?? null
            ]);

            if (!empty($profile_image['name'])) {
                move_uploaded_file($profile_image['tmp_name'], $pathToSaveProfileImg);
            }

            $_SESSION['register'] = true;

            return header("Location: /login");
        } catch (Exception $e) {
            view('error', 'guest', [
                // TODO:
                // 'msg' => "Ocorreu um erro ao registrar o usuário!"
                'msg' => $e->getMessage()
            ]);
        }
    }
}
