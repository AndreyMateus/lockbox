<?php

?>

<div class="w-full p-4 sm:p-6 lg:p-8 max-h-dvh overflow-auto">

    <!-- CABEÇALHO -->
    <div class="mb-6">

        <h1 class="text-2xl sm:text-3xl font-bold">
            Bem-vindo, <?= htmlspecialchars(auth()->name ?? 'Usuário') ?>!
        </h1>

        <p class="text-base-content/60 mt-1">
            Aqui está um resumo das suas notas e atividades recentes.
        </p>

    </div>


    <!-- CARDS PRINCIPAIS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


        <!-- TOTAL DE NOTAS -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:-translate-y-1 hover:shadow-lg">

            <div class="card-body">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-base-content/60">
                            Total de notas
                        </p>

                        <p class="text-3xl font-bold mt-1">
                            <?= array_first($data['qtd_total_notes']) ?? 0 ?>
                        </p>

                    </div>

                    <div class="text-primary text-2xl">
                        📝
                    </div>

                </div>

                <p class="text-xs text-base-content/50 mt-2">
                    Notas atualmente armazenadas
                </p>

            </div>

        </div>


        <!-- NOTAS HOJE -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:-translate-y-1 hover:shadow-lg">

            <div class="card-body">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-base-content/60">
                            Notas hoje
                        </p>

                        <p class="text-3xl font-bold mt-1">
                            <?= array_first($data['qtd_total_notes_today']) ?? 0 ?>
                        </p>

                    </div>

                    <div class="text-success text-2xl">
                        📅
                    </div>

                </div>

                <p class="text-xs text-base-content/50 mt-2">
                    Notas criadas hoje
                </p>

            </div>

        </div>


        <!-- NOTAS EDITADAS -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:-translate-y-1 hover:shadow-lg">

            <div class="card-body">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-base-content/60">
                            Notas editadas
                        </p>

                        <p class="text-3xl font-bold mt-1">
                            <?= $editedNotes ?? 0 ?>
                        </p>

                    </div>

                    <div class="text-warning text-2xl">
                        ✏️
                    </div>

                </div>

                <p class="text-xs text-base-content/50 mt-2">
                    Notas que sofreram alterações
                </p>

            </div>

        </div>


        <!-- NOTAS EXCLUÍDAS -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:-translate-y-1 hover:shadow-lg">

            <div class="card-body">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm text-base-content/60">
                            Notas excluídas
                        </p>

                        <p class="text-3xl font-bold mt-1">
                            <?= $deletedNotes ?? 0 ?>
                        </p>

                    </div>

                    <div class="text-error text-2xl">
                        🗑️
                    </div>

                </div>

                <p class="text-xs text-base-content/50 mt-2">
                    Registros de exclusões
                </p>

            </div>

        </div>

    </div>


    <!-- GRÁFICO + AUDITORIA NOTAS -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-4 mt-4">


        <!-- GRÁFICO -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:shadow-md
                   xl:col-span-2">

            <div class="card-body">

                <div class="mb-5">

                    <h2 class="card-title">
                        Atividade das notas
                    </h2>

                    <p class="text-sm text-base-content/60">
                        Notas criadas nos últimos 7 dias
                    </p>

                </div>


                <?php

                $chart = [
                    'Seg' => 4,
                    'Ter' => 7,
                    'Qua' => 3,
                    'Qui' => 9,
                    'Sex' => 6,
                    'Sáb' => 11,
                    'Dom' => 5
                ];

                $max = max($chart);

                ?>


                <!-- GRÁFICO -->
                <div class="flex items-end justify-between gap-2 h-56">

                    <?php foreach ($chart as $day => $value): ?>

                        <div
                            class="flex flex-col items-center
                                   justify-end h-full flex-1 gap-2">

                            <span class="text-xs text-base-content/60">
                                <?= $value ?>
                            </span>

                            <div
                                class="w-full max-w-10
                                       bg-primary
                                       rounded-t-md
                                       transition-all duration-200"
                                style="height: <?= ($value / $max) * 75 ?>%;"></div>

                            <span class="text-xs text-base-content/60">
                                <?= $day ?>
                            </span>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>


        <!-- AUDITORIA NOTAS -->
        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:shadow-md">

            <div class="card-body">

                <div class="mb-4">

                    <h2 class="card-title">
                        Auditoria Notas
                    </h2>

                    <p class="text-sm text-base-content/60">
                        Últimas operações realizadas nas notas.
                    </p>

                </div>


                <div class="space-y-4">


                    <!-- NOTA CRIADA -->
                    <div class="flex gap-3">

                        <div class="badge badge-success badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Nota criada
                            </p>

                            <p class="text-xs text-base-content/50">
                                Nota "Projeto PHP"
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Hoje às 03:42
                            </p>

                        </div>

                    </div>


                    <!-- NOTA EDITADA -->
                    <div class="flex gap-3">

                        <div class="badge badge-warning badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Nota editada
                            </p>

                            <p class="text-xs text-base-content/50">
                                Nota "Dashboard"
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Hoje às 02:18
                            </p>

                        </div>

                    </div>


                    <!-- NOTA EXCLUÍDA -->
                    <div class="flex gap-3">

                        <div class="badge badge-error badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Nota excluída
                            </p>

                            <p class="text-xs text-base-content/50">
                                Nota "Rascunho"
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Ontem às 23:51
                            </p>

                        </div>

                    </div>


                    <!-- NOTA EDITADA -->
                    <div class="flex gap-3">

                        <div class="badge badge-warning badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Nota editada
                            </p>

                            <p class="text-xs text-base-content/50">
                                Nota "Anotações"
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Ontem às 22:14
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- AUDITORIA PERFIL -->
    <div class="mt-4">

        <div
            class="card bg-base-200 border border-base-content/10
                   transition-all duration-200
                   hover:shadow-md">

            <div class="card-body">

                <div class="mb-4">

                    <h2 class="card-title">
                        Auditoria Perfil
                    </h2>

                    <p class="text-sm text-base-content/60">
                        Últimas operações relacionadas à sua conta.
                    </p>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


                    <!-- LOGIN -->
                    <div class="flex gap-3">

                        <div class="badge badge-success badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Login realizado
                            </p>

                            <p class="text-xs text-base-content/50">
                                Sessão autenticada com sucesso
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Hoje às 03:42
                            </p>

                        </div>

                    </div>


                    <!-- LOGOUT -->
                    <div class="flex gap-3">

                        <div class="badge badge-info badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Logout realizado
                            </p>

                            <p class="text-xs text-base-content/50">
                                Sessão encerrada pelo usuário
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Ontem às 22:30
                            </p>

                        </div>

                    </div>


                    <!-- ALTERAÇÃO DE PERFIL -->
                    <div class="flex gap-3">

                        <div class="badge badge-warning badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Perfil atualizado
                            </p>

                            <p class="text-xs text-base-content/50">
                                Dados do perfil foram alterados
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                Ontem às 20:18
                            </p>

                        </div>

                    </div>


                    <!-- ALTERAÇÃO DE SENHA -->
                    <div class="flex gap-3">

                        <div class="badge badge-warning badge-sm mt-1">
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-medium">
                                Senha alterada
                            </p>

                            <p class="text-xs text-base-content/50">
                                Credencial da conta atualizada
                            </p>

                            <p class="text-xs text-base-content/40 mt-1">
                                09/09/2026 às 18:45
                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>