<?php

use Core\Utils\Validation;

$errors = $data['errors'] ?? [];

// todas as notas
$notes = $data['notes'];
?>


<div class="flex h-full flex-col md:flex-row  lg:w-full">
    <!-- LISTA DE NOTAS -->
    <?php include(base_path("/App/Views/partials/__listNotes.view.php")); ?>

    <!-- EDITOR -->
    <main
        class="flex-1
                   min-w-0
                   min-h-0
                    lg:w-full
                   bg-base-100
                   flex flex-col">


        <!-- Cabeçalho do editor -->
        <header
            class="h-14
                       shrink-0
                       border-b border-base-300
                       flex items-center
                       justify-between
                       px-5">

            <span class="text-sm text-base-content/50">
                Nova nota
            </span>


            <button
                type="submit"
                form="note-form"
                class="btn btn-primary btn-sm">

                Salvar

            </button>

        </header>



        <!-- Área de edição -->
        <section
            class="flex-1
                       overflow-y-auto">


            <form
                id="note-form"
                action="/notes/create"
                method="POST"
                class="max-w-4xl
                           mx-auto
                           px-6
                           sm:px-8
                           lg:px-12
                           py-10
                           sm:py-14
                           lg:py-16">



                <?php if ($error = Validation::haveThisErrorOfLabelInMyArrayErrors('title')): ?>
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= $error['msg'] ?></span>
                    </div>
                <?php endif; ?>

                <!-- Título -->
                <input
                    type="text"
                    name="title"
                    required
                    maxlength="150"
                    placeholder="Título"
                    autocomplete="off"
                    class="input
                               input-ghost
                               w-full
                               h-auto
                               p-0
                               text-3xl
                               sm:text-4xl
                               lg:text-5xl
                               font-bold
                               leading-tight
                               focus:outline-none
                               placeholder:text-base-content/30">


                <!-- Informações -->
                <div
                    class="flex items-center
                               gap-2
                               mt-4
                               mb-8">

                    <span class="text-xs
                                     text-base-content/40">

                        Nova nota

                    </span>

                    <span class="text-base-content/20">
                        •
                    </span>

                    <span class="text-xs
                                     text-base-content/40">

                        Agora

                    </span>

                </div>

                <?php if ($error = Validation::haveThisErrorOfLabelInMyArrayErrors('content')): ?>
                    <div role="alert" class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span><?= $error['msg'] ?></span>
                    </div>
                <?php endif; ?>

                <!-- Conteúdo -->
                <textarea
                    name="content"
                    required
                    placeholder="Comece a escrever..."
                    class="textarea
                               textarea-ghost
                               w-full
                               min-h-[50vh]
                               sm:min-h-[60vh]
                               p-0
                               resize-none
                               text-base
                               sm:text-lg
                               leading-7
                               sm:leading-8
                               focus:outline-none
                               placeholder:text-base-content/30"></textarea>

            </form>

        </section>



        <!-- Rodapé -->
        <footer
            class="h-9
                       shrink-0
                       border-t border-base-300
                       flex items-center
                       justify-end
                       px-5">

            <span
                class="text-xs
                           text-base-content/40">

                0 caracteres

            </span>

        </footer>

    </main>

</div>