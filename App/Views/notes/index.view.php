<?php

use Core\Helpers\Request;

// todas as notas
$notes = $data['notes'];

// nota selecionada para ser exibida
$selectedNote = $data['selectedNote'];
$id = $data['id'];
?>


<div class="flex h-full flex-col md:flex-row lg:w-full">
    <!-- LISTA DE NOTAS -->
    <?php include(base_path("/App/Views/partials/__listNotes.view.php")); ?>

    <!-- VISUALIZAÇÃO DA NOTA -->
    <main
        class="flex-1
               min-w-0
               min-h-0
               bg-base-100
               flex flex-col
               lg:w-full
               ">


        <!-- Cabeçalho -->
        <!-- Cabeçalho do editor -->

        <header class="h-14 lg:w-full
                       shrink-0
                       border-b border-base-300
                       flex items-center
                       justify-between
                       px-5">

            <span class="text-sm text-base-content/50">
                Visualizar nota
            </span>

            <div class="flex gap-2">
                <a href="/notes/update?id=<?= $id ?>">
                    <button
                        type="submit"
                        form="note-form"
                        class="btn btn-primary btn-sm h-full">

                        Atualizar

                    </button>

                </a>

                <form action="/notes" method="POST">
                    <input type="hidden" name="__method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $selectedNote->id ?>">

                    <button
                        href="/notes/delete?id=<?= $selectedNote->id ?>"
                        class="btn btn-error btn-square"
                        title="Excluir nota">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round">

                            <path d="M3 6h18"></path>
                            <path d="M8 6V4h8v2"></path>
                            <path d="M19 6l-1 14H6L5 6"></path>
                            <path d="M10 11v5"></path>
                            <path d="M14 11v5"></path>

                        </svg>

                    </button>

                </form>
            </div>
        </header>


        <!-- Conteúdo -->

        <section class="flex-1 overflow-hidden h-screen">

            <article
                class="max-w-4xl
                       mx-auto
                       px-6
                       h-screen
                       overflow-auto
                       sm:px-8
                       lg:px-12
                       py-10
                       sm:py-14
                       lg:py-16">


                <!-- Título -->

                <h1
                    class="text-3xl
                           sm:text-4xl
                           lg:text-5xl
                           font-bold
                           leading-tight">

                    <?= htmlspecialchars($selectedNote->title ?? '') ?>
                </h1>


                <!-- Conteúdo -->


                <div
                    class="
        mt-8
        w-full
        max-w-4xl
        text-base
        sm:text-lg
        leading-7
        sm:leading-8
        text-base-content
        whitespace-pre-wrap
        break-words
    ">
                    <?= htmlspecialchars($selectedNote->content ?? '') ?>
                </div>


            </article>

        </section>

    </main>

</div>