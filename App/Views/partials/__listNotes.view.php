<?php

use Core\Helpers\Request;

?>

<aside
    class="w-full md:w-72 lg:w-80
               h-52 md:h-full
               bg-base-100
               border-b md:border-b-0 md:border-r
               border-base-300
               flex flex-col
               shrink-0">


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

        <?php if (basename(uri()) === 'create'): ?>
            <div
                class="btn btn-primary btn-sm btn-square"
                title="Nova nota">
                +
            </div>
        <?php else: ?>
            <a
                href="notes/create"
                class="btn btn-primary btn-sm btn-square"
                title="Nova nota">
                +
            </a>
        <?php endif; ?>


    </header>

    <!-- Search Bar -->
    <?php include(base_path('App/Views/partials/__search.view.php')); ?>

    <div class="flex-1 overflow-y-auto">

        <?php foreach ($notes as $index => $note): ?>
            <a
                href="/notes?id=<?= $note->id ?><?= Request::getFieldFormByName("search") ? "&search=" . Request::getFieldFormByName("search") : '' ?>"
                class="block w-full
                           text-left
                           p-4
                           hover:bg-base-200
                           transition
                           <?php
                            // caso o id da nota exista
                            if (basename(uri()) !== 'create') {
                                if ($note->id === $id) {
                                    echo 'bg-base-200 border-l-2 border-primary';
                                }
                                // caso o id da nota seja inexistente
                                else if ($index === 0 && $selectedNote->id !== $id) {
                                    echo 'bg-base-200 border-l-2 border-primary';
                                }
                            }
                            ?>"



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

                    <?= htmlspecialchars($note->updated_at) ?>

                </p>

            </a>

        <?php endforeach; ?>

    </div>

</aside>