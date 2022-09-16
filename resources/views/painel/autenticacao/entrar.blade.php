<x-painel.auth-layout>
    <div class="min-vh-100 d-flex flex-column">
        <header>
            <div class="container-xxl py-5 px-5">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto">
                        <img src="{{ Vite::asset('resources/img/painel/logo.svg') }}" height="24" />
                    </div>
                    <div class="col-auto d-none d-lg-flex">
                        Precisa de ajuda? <a href="#" class="ms-2">Entre em contato</a>
                    </div>
                </div>
            </div>
        </header>

        <div class="w-100 m-auto">
            <div class="container-xl pb-5 px-5">
                <form class="mx-auto" method="POST" action="{{ route('painel.entrar') }}" style="max-width: 480px; width: 100%;">
                    <h1 class="h5 mb-4 text-center">Entrar na sua conta</h1>
                    <x-form.csrf />

                    <div class="row gy-3 flex-column">
                        <div class="col">
                            <div class="form-floating">
                                <x-form.text id="email" class="form-control border rounded-3" type="email" name="email" :value="old('email')" required autofocus />
                                <x-label for="email" :value="'E-mail'" />
                                <x-form.feedback for="email" />
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-floating">
                                <x-form.password id="senha" class="form-control border rounded-3" type="password" name="senha" placeholder="Senha" required autocomplete="current-password" />
                                <x-label for="senha" :value="'Senha'" />
                                <x-form.feedback for="password" />
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-check">
                                <x-input id="remember" class="form-check-input" type="checkbox" name="remember" />
                                <x-label for="remember" class="form-check-label" :value="'Lembre-se de senha'" />
                            </div>
                        </div>

                        <div class="col">
                            <small class="text-muted">Ao continuar, reconheço que li e aceito os <a href="#">Termos de Serviço</a> e a <a href="#">Política de Privacidade</a></small>
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary fw-bold w-100 py-3 rounded-pill">Entrar</button>
                        </div>

                        <div class="col text-center small">
                            <div class="row gy-2 flex-column">
                                <div class="col">
                                    <a href="forgot-password.php" class="fw-bold">Esqueceu sua senha?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <footer class="text-bg-primary">
            <div class="container-xl py-4 px-5">
                <div class="row gx-2 justify-content-center align-items-center">
                    <div class="col-auto">Seu primeiro acesso? <a href="#" class="link-light fw-bold">Cadastre-se</a></div>
                </div>
            </div>
        </footer>
    </div>
</x-painel.auth-layout>
