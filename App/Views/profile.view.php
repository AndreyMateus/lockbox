<main class="w-full max-w-lg h-auto mx-auto p-4 sm:p-6">

    <section class="card bg-base-100 shadow-xl border border-base-300">

        <div class="card-body p-6 sm:p-8">

            <!-- Cabeçalho -->
            <header class="text-center mb-6">

                <h1 class="text-2xl font-bold">
                    Meu Perfil
                </h1>

                <p class="text-sm text-base-content/50 mt-1">
                    Gerencie suas informações pessoais
                </p>

            </header>


            <form action="/profile" method="POST" id="update-user" enctype="multipart/form-data">
                <input type="hidden" name="__method" value="PUT">
                <input type="hidden" name="id" value="<?= htmlspecialchars(auth()->id) ?>">

                <!-- Imagem de perfil -->
                <div class="flex flex-col items-center mb-8">

                    <div class="avatar">

                        <div class="w-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img
                                src="<?= getProfileImg(auth()->profile_img) ?>"
                                alt="Imagem de perfil"
                                class="object-top">

                        </div>

                    </div>


                    <input type="file"
                        class="btn btn-ghost btn-sm text-primary mt-4"
                        name="profile_img"
                        accept="image/png, image/jpeg, image/jpg"
                        value="<?= auth()->profile_img ?>">
                    </input>

                </div>


                <!-- Informações pessoais -->
                <div class="space-y-5">

                    <!-- Nome -->
                    <div class="form-control">

                        <label class="label">
                            <span class="label-text font-medium">
                                Nome
                            </span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="<?= htmlspecialchars(auth()->name) ?? '' ?>"
                            placeholder="Seu nome"
                            class="input input-bordered w-full">

                    </div>


                    <!-- E-mail -->
                    <div class="form-control">

                        <label class="label">
                            <span class="label-text font-medium">
                                E-mail
                            </span>
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="<?= htmlspecialchars(auth()->email) ?? ''  ?>"
                            placeholder="seu@email.com"
                            class="input input-bordered w-full">

                    </div>

                </div>
            </form>

            <div class="divider my-3"></div>

            <!-- Senha -->
            <section class="space-y-6">

                <!-- Segurança -->
                <div>
                    <h2 class="text-lg font-semibold">Segurança</h2>

                    <p class="text-sm text-base-content/60 mt-1 mb-5">
                        Altere sua senha de acesso.
                    </p>


                    <form action="/profile/password" method="POST" class="grid gap-4 sm:grid-cols-2 mb-3" id="password-update">
                        <!-- Spoofing -->
                        <input type="hidden" name="__method" value="PUT">

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Nova senha</span>
                            </div>

                            <input
                                type="password"
                                name="password"
                                class="input input-bordered w-full"
                                placeholder="Digite a nova senha">
                        </label>

                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Confirmar nova senha</span>
                            </div>

                            <input
                                type="password"
                                name="passwordConfirm"
                                class="input input-bordered w-full"
                                placeholder="Confirme a nova senha">
                        </label>
                    </form>
                    <button
                        type="submit"
                        form="password-update"
                        class="btn btn-outline w-full sm:w-auto sm:self-start min-w-[100%]">
                        Alterar senha
                    </button>

                </div>


            </section>




            <!-- Salvar -->
            <div class="mt-6">

                <button
                    form="update-user"
                    type="submit"
                    class="btn btn-primary w-full">

                    Salvar alterações

                </button>

            </div>

        </div>

    </section>


</main>