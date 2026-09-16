<main class="min-w-screen bg-base-300 min-h-dvh max-w-md flex flex-col justify-center items-center">


    <!-- CABEÇALHO -->
    <div class="text-center mb-8">

        <h1 class="text-4xl sm:text-5xl font-bold text-primary">
            Cadastro
        </h1>

        <p class="text-base-content/60 mt-2">
            Crie sua conta para acessar o sistema.
        </p>

    </div>


    <!-- FORMULÁRIO -->
    <form
        action="/register"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-4">


        <!-- NOME -->
        <div class="form-control">

            <label for="nome" class="label">

                <span class="label-text">
                    Nome
                </span>

            </label>

            <input
                type="text"
                id="nome"
                name="name"
                placeholder="Digite seu nome"
                class="input input-bordered w-full"
                required>

            <?php if (!empty($data) && isset($data['name'])): ?>

                <div
                    role="alert"
                    class="alert alert-error mt-2 py-2">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>

                    <span>
                        <?= $data['name']['msg'] ?>
                    </span>

                </div>

            <?php endif; ?>

        </div>


        <!-- E-MAIL -->
        <div class="form-control">

            <label for="email" class="label">

                <span class="label-text">
                    E-mail
                </span>

            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Digite seu e-mail"
                class="input input-bordered w-full"
                required>

            <?php if (!empty($data) && isset($data['email'])): ?>

                <div
                    role="alert"
                    class="alert alert-error mt-2 py-2">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192-1.667 1.732-1.667z" />
                    </svg>

                    <span>
                        <?= $data['email']['msg'] ?>
                    </span>

                </div>

            <?php endif; ?>

        </div>


        <!-- FOTO DE PERFIL -->
        <div class="form-control">

            <label for="profile_image" class="label">

                <span class="label-text">
                    Foto de perfil
                </span>

                <span class="label-text-alt text-base-content/50">
                    Opcional
                </span>

            </label>

            <input
                type="file"
                id="profile_image"
                name="profile_image"
                accept="image/png, image/jpeg, image/jpg"
                class="file-input file-input-bordered w-full">

            <p class="text-xs text-base-content/50 mt-2">
                Selecione uma imagem para usar como foto de perfil.
            </p>

            <?php if (!empty($data) && isset($data['profile_image'])): ?>

                <div
                    role="alert"
                    class="alert alert-error mt-2 py-2">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192-1.667 1.732-1.667z" />
                    </svg>

                    <span>
                        <?= $data['profile_image']['msg'] ?>
                    </span>

                </div>

            <?php endif; ?>

        </div>


        <!-- SENHA -->
        <div class="form-control">

            <label for="senha" class="label">

                <span class="label-text">
                    Senha
                </span>

            </label>

            <input
                type="password"
                id="senha"
                name="password"
                placeholder="Crie uma senha"
                class="input input-bordered w-full"
                required>

            <?php if (!empty($data) && isset($data['password'])): ?>

                <div
                    role="alert"
                    class="alert alert-error mt-2 py-2">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 1.667 1.732 1.667z" />
                    </svg>

                    <span>
                        <?= $data['password']['msg'] ?>
                    </span>

                </div>

            <?php endif; ?>

        </div>


        <!-- CONFIRMAR SENHA -->
        <div class="form-control">

            <label for="confirmar" class="label">

                <span class="label-text">
                    Confirmar senha
                </span>

            </label>

            <input
                type="password"
                id="confirmar"
                name="confirm"
                placeholder="Digite novamente a senha"
                class="input input-bordered w-full"
                required>

            <!-- TODO: ALTERAR PARA A VERIFICACAO SE O VALOR DO CAMPO E O MESMO DO PASSWORD -->

            <?php if (!empty($data) && isset($data['confirm'])): ?>

                <div
                    role="alert"
                    class="alert alert-error mt-2 py-2">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 shrink-0 stroke-current"
                        fill="none"
                        viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77-1.333.192-1.667 1.732-1.667z" />
                    </svg>

                    <span>
                        <?= $data['confirm']['msg'] ?>
                    </span>

                </div>

            <?php endif; ?>

        </div>


        <!-- BOTÃO -->
        <button
            type="submit"
            class="btn btn-primary w-full mt-2">
            Criar conta
        </button>


    </form>


    <!-- RODAPÉ -->
    <p class="text-center text-sm text-base-content/60 mt-6">

        Já possui uma conta?

        <a
            href="/login"
            class="link link-primary">
            Entrar
        </a>

    </p>


</main>