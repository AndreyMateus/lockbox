<?php
?>

<div class="w-full max-w-md mx-auto">
    <div class="card bg-base-200 border border-base-content/10">
        <div class="card-body">

            <h2 class="card-title">
                Desbloquear notas
            </h2>

            <p class="text-sm text-base-content/60">
                Digite sua senha para desbloquear o acesso às suas notas.
            </p>

            <form action="/notes/unlock" method="POST" class="mt-4">

                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text">
                            Senha
                        </span>
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Digite sua senha"
                        class="input input-bordered w-full"
                        required
                        autocomplete="current-password">
                </div>

                <button
                    type="submit"
                    class="btn btn-primary w-full mt-5">
                    Desbloquear
                </button>

            </form>

        </div>
    </div>
</div>