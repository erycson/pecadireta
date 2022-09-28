<x-website.default-layout>
    <!-- Header -->
    <header class="bg-dark py-3 py-lg-4 position-relative">
        <div class="container-xl position-relative" style="z-index: 3;">
            <div class="bg-white rounded-3 p-4 mb-1">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto d-lg-none">
                        <a data-bs-toggle="offcanvas" data-bs-target="#offcanvasResponsive" aria-controls="offcanvasResponsive"
                            role="button" class="link-dark">
                            <i class='bx bx-menu bx-sm d-flex'></i>
                        </a>
                    </div>
                    <div class="col-auto">
                        <a href="index.php">
                            <img src="{{ Vite::asset('resources/img/website/logo.svg') }}" height="42" class="logo" />
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <a href="#" class="link-dark d-none d-lg-flex fw-bold">
                            <i class='bx bxl-whatsapp bx-sm me-1 text-success'></i> Atendimento
                        </a>
                    </div>
                    <div class="col-auto d-lg-none">
                        <a href="#" class="link-dark">
                            <i class='bx bx-user-circle bx-sm d-flex'></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="offcanvas-lg offcanvas-start offcanvas-menu border-0" tabindex="-1" id="offcanvasResponsive"
                aria-labelledby="offcanvasResponsiveLabel">
                <div class="offcanvas-header bg-light align-items-center">
                    <img src="{{ Vite::asset('resources/img/website/logo.svg') }}" height="24" />
                    <a href="#" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasResponsive" aria-label="Close"
                        class="link-secondary">
                        <i class='bx bx-x bx-sm d-flex'></i>
                    </a>
                </div>
                <div class="offcanvas-body">
                    <div
                        class="w-100 bg-white bg-opacity-15 blur rounded-3 py-lg-3 px-lg-4 d-lg-flex justify-content-between align-items-center position-relative">
                        <div class="row gx-lg-4 gy-2 mb-2 mb-lg-0">

                            <div class="col-lg-auto d-lg-none">
                                <a href="#" class="link-light rounded-3">Login</a>
                            </div>
                            <div class="col-lg-auto d-lg-none">
                                <a href="#" class="link-light rounded-3">Cadastre-se</a>
                            </div>

                            <div class="col-lg-auto">
                                <a href="#" class="link-light rounded-3">Sobre</a>
                            </div>
                            <div class="col-lg-auto">
                                <a href="#" class="link-light rounded-3">Anunciantes</a>
                            </div>
                            <div class="col-lg-auto">
                                <a href="#" class="link-light rounded-3">Peças Obsoletas</a>
                            </div>
                            <div class="col-lg-auto">
                                <a href="#" class="link-light rounded-3">Anuncie seu estoque</a>
                            </div>
                            <div class="col-lg-auto">
                                <a href="#" class="link-light rounded-3">Contato</a>
                            </div>
                        </div>

                        <a href="#" class="d-none d-lg-flex align-items-center link-light">
                            <i class='bx bx-xs bxs-user p-1 me-2 bg-primary rounded-circle text-white'></i>
                            Acessar
                        </a>
                    </div>
                </div>
            </div>

            <div class="search pt-5 pb-1 py-lg-5 my-lg-5 text-center">
                <span class="badge bg-primary mb-2 py-2 px-3 bg-opacity-50">BUSCADOR DE AUTOPEÇAS VIA WEB</span>
                <h2 class="text-white mb-4 text-center px-5">Localize a peça que você precisa</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <form class="bg-white bg-opacity-15 blur rounded-4 p-3 p-lg-5">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg border-0" placeholder="Digite o código ou descrição da peça" aria-label="Digite o código ou descrição da peça" aria-describedby="button-addon2">
                                <button class="btn btn-lg btn-primary px-4" type="button" OnClick=" location.href='search.php' ">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <a href="#content" class="position-absolute top-100 start-50 translate-middle text-bg-primary rounded-circle d-none d-lg-block" style="z-index: 1;">
            <i class='bx bx-sm bx-down-arrow-alt p-2 text-white'></i>
        </a>

        <div class="bg-home w-100 h-100 bg-dark position-absolute top-50 start-50 translate-middle" style="background-image: url({{ Vite::asset('resources/img/website/bg-home.png') }})"></div>
    </header>

    <a id="content"></a>

    @include('website.home.partials._anunciantes')

    <!-- Ad -->
    <div class="row gx-0 mb-lg-5 mb-4">
        <div class="col-lg-6">
            <img src="{{ Vite::asset('resources/img/website/ads.jpg') }}" class="w-100 img-fluid rounded-start rounded-pill" />
        </div>
        <div class="col-lg-6 d-flex align-items-center">
            <div class="container p-lg-5 py-4">
                <h4 class="h2 mb-4">Anuncie seu estoque de peças e acessórios automotivos para todo Brasil, por <strong class="text-success">90 dias grátis!</strong></h4>
                <p class="mb-4">O Peça Direta é a forma mais inovadora de integração de estoques de autopeças e acessórios automotivos entre concessionários, distribuidores, lojas de peças multimarcas, oficinas e para o público em geral, para buscar e comprar autopeças e acessórios de forma direta, sem intermediários e sem comissões. Aqui são encontrados mais de 1.000 fornecedores, com os mais variados estoques de autopeças e acessórios de todo Brasil.</p>
                <a href="#" class="btn btn-lg btn-primary py-2 px-4 rounded-3">Quero anunciar meu estoque</a>
            </div>
        </div>
    </div>

    @include('website.home.partials._diferenciais')

    @include('website.home.partials._parceiros')

    <!-- Footer -->
    <footer class="text-bg-dark">
        <div class="container-xl py-5">
            <div class="nav row gy-4 gx-xl-5">
                <div class="col-lg-3">
                    <h6 class="mb-4">Institucional</h6>
                    <div class="row gy-1 flex-column small">
                        <div class="col"><a href="#" class="link-light">Sobre</a></div>
                        <div class="col"><a href="#" class="link-light">Anunciantes</a></div>
                        <div class="col"><a href="#" class="link-light">Peças Obsoletas</a></div>
                        <div class="col"><a href="#" class="link-light">Contato</a></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <hr class="pb-4 d-block d-lg-none" />
                    <h6 class="mb-4">Saiba mais</h6>
                    <div class="row gy-1 flex-column small">
                        <div class="col"><a href="#" class="link-light">Anuncie seu estoque</a></div>
                        <div class="col"><a href="#" class="link-light">Dúvidas frequentes</a></div>
                        <div class="col"><a href="#" class="link-light">Política de privacidade</a></div>
                        <div class="col"><a href="#" class="link-light">Termos de uso</a></div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <hr class="pb-4 d-block d-lg-none" />
                    <h6 class="mb-4">Central do Cliente</h6>
                    <div class="row gy-1 flex-column small">
                        <div class="col"><a href="#" class="link-light d-inline-flex"><i class='bx bx-sm bx-envelope me-2' ></i>sac@pecadireta.com.br</a></div>
                        <div class="col"><a href="#" class="link-success d-inline-flex"><i class='bx bx-sm bxl-whatsapp me-2' ></i>Atendimento</a></div>
                        <div class="col">
                            <span class="d-block fw-bold">Horário de atendimento:</span> Segunda a sexta-feira das 9h às 17h
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <hr class="pb-4 d-block d-lg-none" />
                    <h6 class="mb-4">Redes Sociais</h6>
                    <div class="row flex-column gy-1 small">
                        <div class="col">
                            <a href="#" class="link-light d-inline-flex">
                                <i class='bx bx-sm bxl-facebook-circle me-2' ></i>
                                Facebook
                            </a>
                        </div>
                        <div class="col"><a href="#" class="link-light d-inline-flex"><i class='bx bx-sm bxl-instagram me-2' ></i> Instagram</a></div>
                    </div>
                </div>
            </div>

            <hr class="my-5" />

            <div class="row gy-3 justify-content-center text-center">
                <div class="col-auto"><img src="{{ Vite::asset('resources/img/website/logo-footer.svg') }}" height="90" /></div>
                <div class="col-12 small"><small>© Copyright <script>document.write(new Date().getFullYear())</script> Peça Direta. Todos os Direitos Reservados. <span class="d-block">CNPJ: 14.001.429/0001-08</span></small></div>
                <div class="col-auto">
                    <a href="https://www.aurasoft.com.br/">
                        <img src="https://www.aurasoft.com.br/assets/img/logo-aurasoft-white.svg" height="18" />
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <x-slot:javascripts>
        @vite('resources/js/website/home/index.jsx')
    </x-slot>
</x-website.default-layout>
