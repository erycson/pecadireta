<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Rifa Aqui') }}</title>

    @vite('resources/css/website/global.scss')
    {!! $stylesheets ?? '' !!}
</head>

<body>

    <!-- Header -->
    <header class="bg-primary sticky-top">
        <div class="container-xl py-3 py-lg-4 position-relative">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <a class="d-flex align-items-center fw-bold link-dark d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasWithBothOptions" role="button" aria-controls="offcanvasWithBothOptions">
                        <i class='bx bx-sm bx-menu me-2'></i>
                    </a>
                    <a href="index.php" class="d-none d-lg-block">
                        <img src="{{ Vite::asset('assets/website/img/logo-rifeaqui.svg') }}">
                    </a>
                </div>
                <div class="col-auto col-lg-5 position-absolute top-50 start-50 translate-middle">
                    <div class="search-header d-none d-lg-block position-relative">
                        <button class="btn btn-primary text-white rounded-circle p-1 d-flex position-absolute top-50 end-0 translate-middle-y ms-2"><i class='bx bx-sm bx-search'></i></button>
                        <input class="form-control form-control-sm rounded-pill" type="text" placeholder="O que você procura" aria-label="O que você procura">
                    </div>
                    <a href="index.php" class="d-block d-lg-none">
                        <img src="{{ Vite::asset('assets/website/img/logo-rifeaqui.svg') }}">
                    </a>
                </div>
                <div class="col-auto">
                    <div class="row gx-3 align-items-center">
                        <div class="col-auto">
                            <a href="login.php" class="link-dark d-flex align-items-center">
                                <i class='bx bx-user bx-sm me-2'></i>
                                <span class="small lh-sm d-none d-lg-block">
                                    <strong class="d-block">Entrar</strong> Criar conta
                                </span>
                            </a>
                        </div>

                        <div class="col-auto d-none">
                            <div class="dropdown">
                                <a class="link-dark d-flex align-items-center" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-user bx-sm me-2'></i>
                                    <span class="small lh-sm d-none d-lg-block">
                                        <strong class="d-block">Olá, Felipe</strong> Veja sua conta
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                    <li><button class="dropdown-item small" type="button">Favoritos</button></li>
                                    <li><button class="dropdown-item small" type="button">Rifas</button></li>
                                    <li><button class="dropdown-item small" type="button">Informações Pessoais</button></li>
                                    <li><button class="dropdown-item small" type="button">Endereço</button></li>
                                    <li><button class="dropdown-item small" type="button">Acessos e segurança</button></li>
                                    <li><button class="dropdown-item small" type="button">Convide um amigo</button></li>
                                    <li><button class="dropdown-item small link-danger" type="button">Sair</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Menu -->
    <nav class="menu container-xl py-4 d-none d-lg-block">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <a class="d-flex align-items-center fw-bold link-dark" data-bs-toggle="offcanvas" href="#offcanvasWithBothOptions" role="button" aria-controls="offcanvasWithBothOptions">
                    <i class='bx bx-sm bx-menu me-2'></i>Todas categorias
                </a>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Celulares</a></div>
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Smartwatch</a></div>
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Imóveis</a></div>
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Veículos</a></div>
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Viagens</a></div>
                    <div class="col-auto"><a href="lista-produto.php" class="link-dark">Jantar</a></div>
                </div>
            </div>
            <div class="col-auto">
                <a href="como-funciona.php" class="link-dark">Como funciona</a>
            </div>
        </div>
    </nav>

    <!-- Menu Offcanvas -->
    <div class="offcanvas offcanvas-start rounded-3 border-0 overflow-hidden" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="bg-primary p-3">
            <a role="button" class="link-dark d-flex align-items-center small" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class='bx bx-left-arrow-alt me-1 bx-xs'></i>
                <strong>Fechar menu</strong>
            </a>
        </div>

        <div class="bg-primary bg-opacity-75 p-3">
            <a href="login.php" class="link-dark d-flex align-items-center">
                <i class='bx bx-user bx-sm me-2'></i>
                <span class="small lh-sm">
                    <strong class="d-block">Entrar</strong> Criar conta
                </span>
            </a>

            <a href="login.php" class="link-dark d-flex align-items-center d-none">
                <i class='bx bx-user bx-sm me-2'></i>
                <span class="small lh-sm">
                    <strong class="d-block">Olá, Felipe.</strong> Alterar meus dados
                </span>
            </a>
        </div>

        <div class="offcanvas-body p-3">
            <h6 class="small fw-bold">Categorias</h6>
            <div class="list-group mb-4">
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Celulares</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Smartwatch</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Imóveis</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Veículos</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Viagens</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Jantar</a>
            </div>

            <h6 class="small fw-bold">Minha conta</h6>
            <div class="list-group">
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Favoritos</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Rifas</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Informações Pessoais</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Endereço</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Acessos e segurança</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action">Convide um amigo</a>
                <a href="lista-produto.php" class="list-group-item list-group-item-action link-danger">Sair</a>
            </div>
        </div>
    </div>

    <!-- Search -->
    <div class="bg-primary bg-opacity-75 py-2 d-block d-lg-none">
        <div class="container-xl">
            <div class="position-relative">
                <a class="link-dark d-flex position-absolute top-50 end-0 translate-middle-y me-2" role="button"><i class='bx bx-search'></i></a>
                <input class="form-control form-control-sm px-3 rounded-pill border-0" type="text" placeholder="O que você procura" aria-label="O que você procura">
            </div>
        </div>
    </div>

    {{ $slot }}

    <!-- Footer -->
    <footer>

        <div class="border-top">
            <div class="container-xl py-4 position-relative overflow-hidden">
                <div class="row g-5">
                    <div class="col-auto border-end">
                        <a href="#" class="d-flex align-items-center link-dark">
                            <i class='bx bx-sm bxl-apple me-2'></i>
                            <small class="lh-sm">Breve na <strong class="d-block">App Store</strong></small>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="d-flex align-items-center link-dark">
                            <i class='bx bx-sm bxl-play-store me-2'></i>
                            <small class="lh-sm">Breve no <strong class="d-block">Google Play</strong></small>
                        </a>
                    </div>
                </div>
                <img src="{{ Vite::asset('assets/website/img/logo-rifeaqui-yellow.svg') }}" class="d-none d-lg-block position-absolute top-50 start-50 translate-middle">
            </div>
        </div>

        <div class="border-top">
            <div class="container-xl py-3 py-lg-5 overflow-hidden">
                <div class="row row-cols-1 row-cols-lg-4 gy-4 gx-5 small nav-footer">
                    <div class="col col-nav">
                        <div class="row gy-1 flex-column">
                            <div class="col"><strong>Atendimento</strong></div>
                            <div class="col"><a href="#" class="link-dark">Central de Ajuda</a></div>
                            <div class="col"><a href="#" class="link-dark">Como Comprar</a></div>
                            <div class="col"><a href="#" class="link-dark">Métodos de Pagamento</a></div>
                            <div class="col"><a href="#" class="link-dark">Fale Conosco</a></div>
                        </div>
                        <hr class="d-block d-lg-none mt-4 mb-0">
                    </div>

                    <div class="col col-nav">
                        <div class="row gy-1 flex-column">
                            <div class="col"><strong>Institucional</strong></div>
                            <div class="col"><a href="#" class="link-dark">Sobre o Rife Aqui</a></div>
                            <div class="col"><a href="#" class="link-dark">Blog</a></div>
                            <div class="col"><a href="#" class="link-dark">Histórias dos Ganhadores</a></div>
                        </div>
                        <hr class="d-block d-lg-none mt-4 mb-0">
                    </div>

                    <div class="col col-nav">
                        <div class="row gy-1 flex-column">
                            <div class="col"><strong>Formas de Pagamento</strong></div>
                            <div class="col mb-2">Cartões de crédito e débito via:</div>
                            <div class="col"><img src="{{ Vite::asset('assets/website/img/logo-paypal.svg') }}"></div>
                        </div>
                        <hr class="d-block d-lg-none mt-4 mb-0">
                    </div>

                    <div class="col col-nav">
                        <div class="row gy-1 flex-column">
                            <div class="col"><strong>Minha conta</strong></div>
                            <div class="col"><a href="#" class="link-dark">Entrar</a></div>
                            <div class="col"><a href="#" class="link-dark">Criar uma conta</a></div>
                            <div class="col"><a href="#" class="link-dark">Esqueci minha senha</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top">
            <div class="container-xl py-3 overflow-hidden small">
                <div class="row g-2 align-items-center justify-content-between">
                    <div class="col-lg-auto">
                        <div class="row gy-2 gx-3">
                            <div class="col-lg-auto">© 2022 Rife Aqui</div>
                            <div class="col-auto"><a href="#" class="link-dark">Termos de Uso</a></div>
                            <div class="col-auto"><a href="#" class="link-dark">Política de Privacidade</a></div>
                        </div>
                    </div>
                    <div class="col-lg-auto">
                        <div class="row gx-2">
                            <div class="col-auto">Português (BR)</div>
                            <div class="col-auto">R$ BRL</div>
                            <div class="col-auto"><a href="#" class="link-dark"><i class='bx bx-sm bxl-facebook-square'></i></a></div>
                            <div class="col-auto"><a href="#" class="link-dark"><i class='bx bx-sm bxl-instagram'></i></a></div>
                            <div class="col-auto"><a href="#" class="link-dark"><i class='bx bx-sm bxl-twitter'></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top">
            <div class="container-xl py-3 text-center">
                <p class="small-xs mb-2">Rife Aqui LTDA / CNPJ: 00.000.000/0000-00 / Rua Nome da Local, 0000 - São Paulo, SP - 00000-000</p>
                <a href="https://www.aurasoft.com.br/"><img src="https://www.aurasoft.com.br/assets/img/logo-aurasoft.svg"></a>
            </div>
        </div>
    </footer>

    @vite('assets/painel/js/global.js')
    {!! $javascripts ?? '' !!}
</body>

</html>
