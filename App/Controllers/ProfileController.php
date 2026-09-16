<?php

namespace App\Controllers;

use Core\Helpers\Request;
use App\Database\Database;
use App\Models\UserModel;
use finfo;
use Exception;
use PDOException;
use DateTime;

class ProfileController
{

    public function __invoke()
    {
        return view('profile');
    }

    public function update()
    {
        $id = (int)Request::getFieldPostFormByName('id');
        $email = Request::getFieldPostFormByName('email');
        $name = Request::getFieldPostFormByName('name');
        // TODO: falta REMOVER a imagem antiga quando trocar de foto, falta VALIDAR quando nao inserir imagem nenhuma (pode ser um if)
        $profile_image = !empty($_FILES['profile_img']['name']) ? $_FILES['profile_img'] : auth()->profile_img;
        $updated_at = new DateTime()->format('Y-m-d H:i:s');

        if (is_array($profile_image)) {

            $pathToSaveProfileImg = convert_separator_of_path(base_path("Public\\uploads\\profile_images\\") . uniqid() . $profile_image['name']);
            $f =  new finfo();
            $mimetypeOfSendFile = $f->file($profile_image['tmp_name'], FILEINFO_MIME_TYPE);

            $whitelist = ["image/png", "image/jpeg", "image/jpg"];
            if (!in_array($mimetypeOfSendFile, $whitelist)) {
                // TODO: substituir essa exception por um erro/aviso visual para o usuario!
                throw new Exception("Tipo de imagem inválido!");
            }
        }

        try {
            $conn = new Database();

            $conn->query(
                "UPDATE users SET 
                name = :name, 
                email = :email,
                updated_at = :updated_at,
                profile_img = :profile_img
                WHERE id = :id",
                [
                    ':id' => $id,
                    ':name' => $name,
                    ':email' => $email,
                    ':profile_img' => $pathToSaveProfileImg ?? auth()->profile_img,
                    ':updated_at' => $updated_at
                ]
            );

            if (is_array($profile_image)) {
                move_uploaded_file($profile_image['tmp_name'], $pathToSaveProfileImg);
            }

            // Atualizando a session
            $stmt = $conn->query("SELECT id,name,email,updated_at,profile_img FROM users WHERE id = :id", [
                ':id' => $id
            ], UserModel::class);

            $row = $stmt->fetch();
            $_SESSION['user'] = $row;

            return redirect('/profile');
        } catch (PDOException $err) {
            // 
        }
    }

    public function changePassword()
    {
        try {
            // TODO: colocar as validacoes de entrada
            $password = Request::getFieldPostFormByName('password');
            $confirmPassword = Request::getFieldPostFormByName('confirmPassword');

            if ($password !== $confirmPassword) {
                // TODO: avisar que o os password sao difentes para o USUARIO e precisam ser iguais
            }

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $conn = new Database();

            $conn->query("UPDATE users AS u SET password = :password WHERE u.id = :id", [
                ':id' => auth()->id,
                ':password' => $passwordHash
            ]);

            // TODO: exibir mensagem de sucesso que a senha foi alterada

            return redirect('/profile');
        } catch (Exception $err) {
            // 
        }
    }
}
