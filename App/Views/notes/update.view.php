<?php

use Core\Utils\Validation;

// todas as notas
$notes = $data['notes'];

$id = $data['id'];

// nota selecionada
$selectedNote = $data['selectedNote'];
?>

<div class="flex h-full flex-col md:flex-row  lg:w-full">
    <!-- LISTA DE NOTAS -->
    <aside
        class="w-full md:w-72 lg:w-80
                   h-52 md:h-full
                   bg-base-100
                   border-b md:border-b-0 md:border-r
                   border-base-300
                   flex flex-col
                   shrink-0">


        <!-- Cabeçalho -->

        <header
            class="p-4
                       border-b border-base-300
                       flex items-center justify-between">

            <div>

                <h2 class="font-semibold text-lg">
                    Notas
                </h2>

                <p class="text-xs text-base-content/50">
                    Suas anotações
                </p>

            </div>


            <!-- Nova nota -->

            <button
                class="btn btn-primary btn-sm btn-square"
                title="Nova nota">

                +

            </button>

        </header>



        <!-- Pesquisa -->

        <div class="p-3">

            <label class="input input-sm w-full">

                <svg
                    class="h-[1em] opacity-50"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">

                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor">

                        <circle
                            cx="11"
                            cy="11"
                            r="8">
                        </circle>

                        <path
                            d="m21 21-4.3-4.3">
                        </path>

                    </g>

                </svg>

                <input
                    type="search"
                    placeholder="Pesquisar">

            </label>

        </div>



        <!-- Lista -->

        <div class="flex-1 overflow-y-auto">

            <?php foreach ($notes as $index => $note): ?>
                <a
                    href="/notes/update?id=<?= $note->id ?>"
                    class="block w-full
                               text-left
                               p-4
                               hover:bg-base-200
                               transition
                               <?php

                                if ($note->id === $id) {
                                    echo 'bg-base-200 border-l-2 border-primary';
                                } else if (
                                    $index === 0 &&
                                    $selectedNote->id !== $id
                                ) {
                                    echo 'bg-base-200 border-l-2 border-primary';
                                }

                                ?>">

                    <p class="font-medium truncate">
                        <?= htmlspecialchars($note->title) ?>
                    </p>

                    <p
                        class="text-xs
                                   text-base-content/50
                                   mt-1
                                   truncate">

                        <?= htmlspecialchars($note->content) ?>

                    </p>

                    <p
                        class="text-xs
                                   text-base-content/40
                                   mt-2">

                        <?= htmlspecialchars($note->created_at ?? '') ?>

                    </p>

                </a>

            <?php endforeach; ?>

        </div>

    </aside>

    <!--EDITOR -->
    <main
        class="flex-1
                   min-w-0
                   min-h-0
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

                Editar nota

            </span>

            <a
                href="/notes?id=<?= $id ?>"
                class="btn btn-ghost">
                Cancelar
            </a>

            <button
                type="submit"
                form="note-form"
                class="btn btn-primary btn-sm">

                Salvar

            </button>

        </header>

        <div class="relative">

            <!-- CARD: MODO DE EDIÇÃO -->
            <div
                class="
            absolute
            top-0
            left-0
            right-0
            z-10
            bg-warning
            text-warning-content
            px-4
            py-2
            text-center
            text-sm
            font-semibold
            tracking-wide
            border-b
            border-warning-content/20
        ">
                MODO DE EDIÇÃO ATIVADO
            </div>

            <!-- conteúdo do pai -->

        </div>

        <!-- Área de edição -->

        <section
            class="flex-1
                       overflow-y-auto">


            <form action="/notes/update" method="POST"
                id="note-form"
                class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 py-10 sm:py-14 lg:py-16">

                <!-- ID da nota -->
                <input type="hidden" name="id" value="<?= htmlspecialchars($selectedNote->id ?? '') ?>">
                <!-- Fake Spoofing for use PUT VERB of HTTP -->
                <input type="hidden" name="__method" value="PUT">

                <!-- Erro do título -->

                <?php if ($error = Validation::haveThisErrorOfLabelInMyArrayErrors('title')): ?>

                    <div
                        role="alert"
                        class="alert alert-error mb-4">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 shrink-0 stroke-current"
                            fill="none"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        <span>
                            <?= $error['msg'] ?>
                        </span>

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
                    value="<?= htmlspecialchars($selectedNote->title ?? '') ?>"
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

                    <span
                        class="text-xs
                                   text-base-content/40">

                        Editando nota

                    </span>

                    <span class="text-base-content/20">
                        •
                    </span>

                    <span
                        class="text-xs
                                   text-base-content/40">

                        <?= htmlspecialchars($selectedNote->created_at ?? '') ?>

                    </span>

                </div>



                <!-- Erro do conteúdo -->

                <?php if ($error = Validation::haveThisErrorOfLabelInMyArrayErrors('content')): ?>

                    <div
                        role="alert"
                        class="alert alert-error mb-4">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 shrink-0 stroke-current"
                            fill="none"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />

                        </svg>

                        <span>
                            <?= $error['msg'] ?>
                        </span>

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
                               placeholder:text-base-content/30"><?= htmlspecialchars($selectedNote->content ?? '') ?></textarea>


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

                <?= strlen($selectedNote->content ?? '') ?> caracteres

            </span>

        </footer>

    </main>

</div>