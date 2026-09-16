<?php

?>

<!-- BARRA LATERAL -->

<aside
    id="bar"
    class="
        relative
        shrink-0
        w-full
        h-14
        sm:h-16
        min-h-0
        lg:w-16
        lg:h-full
        lg:min-h-[100dvh]
       
        bg-base-300
        border-b
        lg:border-b-0
        lg:border-r
        border-base-content/10
        flex
        flex-row
        lg:flex-col
        items-center
        justify-between
        lg:justify-start
        px-3
        sm:px-4
        md:px-6
        lg:px-0
        py-2
        sm:py-3
        lg:py-4
    ">

    <!-- Logo -->
    <a href="/profile">
        <img src="<?= getProfileImg(auth()->profile_img); ?>" alt="" class="btn btn-primary btn-square btn-xs sm:btn-sm lg:btn-md object-cover object-top">
    </a>


    <!-- NAVEGAÇÃO -->
    <nav
        class="
            flex
            flex-row
            lg:flex-col
            items-center
            gap-1
            sm:gap-2
            md:gap-3
            lg:gap-2
            lg:mt-6
        ">

        <!-- Dashboard -->
        <a
            href="/dashboard"
            class="btn btn-ghost btn-square btn-xs sm:btn-sm lg:btn-md <?= automaticSelectMenu("/dashboard") ?>"
            title="Dashboard">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 sm:w-5 sm:h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6" />
            </svg>
        </a>


        <!-- Create Note -->
        <a
            href="/notes/create"
            class="btn btn-ghost btn-square btn-xs sm:btn-sm lg:btn-md <?= automaticSelectMenu("/notes/create") ?>"
            title="Criar nota">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 sm:w-5 sm:h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
        </a>


        <!-- List Notes -->
        <a
            href="/notes"
            class="btn btn-ghost btn-square btn-xs sm:btn-sm lg:btn-md <?= automaticSelectMenu("/notes") ?>"
            title="Listar notas">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 sm:w-5 sm:h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
            </svg>
        </a>

    </nav>


    <!-- LOGOUT -->
    <a
        href="/logout"
        class="btn btn-ghost btn-square btn-xs sm:btn-sm lg:btn-md lg:mt-auto"
        title="Logout"
        onclick="return confirm('Deseja fazer logout ?')">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 sm:w-5 sm:h-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3" />
        </svg>
    </a>

</aside>