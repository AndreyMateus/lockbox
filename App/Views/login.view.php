<?php

$errors = $data;

/* Flash messages - Mensagens rápidas de notificação */

$hasARegister = false;

if (isset($_SESSION["register"]) && $_SESSION["register"]) {

    $hasARegister = $_SESSION["register"];

    session_destroy();
}

?>
<div class="min-h-screen min-w-screen bg-base-300 text-base-content flex items-center justify-center p-4">
    <main class="w-full max-w-sm ">

        <h1 class="text-5xl font-bold text-primary text-center mb-2">
            Login
        </h1>

        <p class="text-center text-base-content/60 mb-10 leading-relaxed">
            Entre com suas credenciais para acessar o sistema.
        </p>


        <!-- MENSAGEM PÓS REGISTRO -->

        <?php if ($hasARegister): ?>

            <div
                role="alert"
                class="alert alert-success mb-3 py-2">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span>
                    Sua conta foi criada com sucesso!
                </span>

            </div>

        <?php endif; ?>


        <!-- ERRO DE LOGIN -->

        <?php if (isset($errors['login'])): ?>

            <div
                role="alert"
                class="alert alert-error mb-3 py-2">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <span>
                    <?= $errors['login']['msg'] ?>
                </span>

            </div>

        <?php endif; ?>


        <form action="/login" method="POST" class="space-y-5">


            <!-- E-MAIL -->

            <div>

                <label
                    for="email"
                    class="block text-sm font-medium text-base-content mb-2">
                    E-mail
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    class="input input-bordered w-full">

                <?php foreach ($errors as $errorArr): ?>

                    <?php if (
                        isset($errorArr['fieldName']) &&
                        $errorArr['fieldName'] === "email"
                    ): ?>

                        <?php foreach ($errorArr as $key => $value): ?>

                            <?php if ($key === 'msg'): ?>

                                <p class="mt-1.5 text-sm font-medium text-error">
                                    ⚠ <?= $value ?>
                                </p>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>


            <!-- SENHA -->

            <div>

                <label
                    for="senha"
                    class="block text-sm font-medium text-base-content mb-2">
                    Senha
                </label>

                <input
                    id="senha"
                    type="password"
                    name="password"
                    placeholder="Digite sua senha"
                    class="input input-bordered w-full">

                <?php foreach ($errors as $errorArr): ?>

                    <?php if (
                        isset($errorArr['fieldName']) &&
                        $errorArr['fieldName'] === "password"
                    ): ?>

                        <?php foreach ($errorArr as $key => $value): ?>

                            <?php if ($key === 'msg'): ?>

                                <p class="mt-1.5 text-sm font-medium text-error">
                                    ⚠ <?= $value ?>
                                </p>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                <?php endforeach; ?>

            </div>


            <!-- OPÇÕES -->

            <div class="flex items-center justify-between my-6 text-sm">

                <label class="flex items-center gap-2 cursor-pointer">

                    <input
                        type="checkbox"
                        class="checkbox checkbox-primary checkbox-sm">

                    <span>
                        Lembrar-me
                    </span>

                </label>

                <a
                    href="#"
                    class="link link-primary">
                    Esqueci minha senha
                </a>

            </div>


            <!-- BOTÃO -->

            <button
                type="submit"
                name="login"
                class="btn btn-primary w-full">
                Entrar
            </button>


            <!-- REGISTRO -->

            <div class="text-center text-sm text-base-content/60 mt-6">

                <span>
                    Ainda não tem uma conta?
                </span>

                <a
                    href="/register"
                    class="link link-primary font-semibold ml-1">
                    Registre-se
                </a>

            </div>


        </form>

    </main>
</div>