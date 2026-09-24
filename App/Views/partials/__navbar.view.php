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
bg-base-300
border-b
border-base-content/10
flex
        flex-row
        items-center
        
        px-3
        py-2
        sm:px-4
        sm:py-3
        md:px-6
        lg:w-16
        lg:h-full
        lg:min-h-[100dvh]
        lg:border-b-0
        lg:border-r
        lg:flex-col
        justify-between
        lg:px-0
        lg:py-4
        ">

    <div class="flex lg:flex-col">
        <!-- Logo -->
        <a href="/profile">
            <img src="<?= getProfileImg(auth()->profile_img); ?>" class="btn btn-primary btn-square btn-xs sm:btn-sm lg:btn-md object-cover object-top">
        </a>

        <!-- NAVEGAÇÃO -->
        <nav
            class="flex flex-row items-center gap-1 sm:gap-2 md:gap-3 lg:flex-col lg:gap-2 lg:mt-6 lg:justify-between ">

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
    </div>

    <!-- TODO: verificar onde está sobreescrevendo as classes do tailwind e remover o style. -->
    <!-- style="display: flex; flex-direction: column; justify-content: center; align-items: center;" -->
    <div class="flex justify-center items-center lg:flex-col">
        <!-- Lock|Unlock Notes -->
        <?php if (session()->get('visible')): ?>
            <!-- Cadeado fechado -->
            <a href="/notes/lock" class="btn btn-ghost btn-sm gap-2"> <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 0 1 8 0v4" />
                </svg></a>
        <?php endif; ?>

        <?php if (!session()->get('visible')): ?>
            <!-- Cadeado aberto -->
            <a href="/notes/unlock" class="btn btn-ghost btn-sm gap-2"> <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <rect x="5" y="11" width="14" height="10" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 11V7a4 4 0 0 1 8 0" />
                </svg> </a>
        <?php endif; ?>


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

    </div>

</aside>