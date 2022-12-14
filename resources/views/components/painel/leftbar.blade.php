@php ($currentRoute = request()->route()->getName())
<div class="sidebar offcanvas-lg offcanvas-start d-flex flex-column" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <header class="header-sidebar d-flex align-items-center border-bottom sticky-top">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a href="{{ route('painel.dashboard') }}" class="logo-light">
                <img src="{{ Vite::asset('resources/img/painel/logo.svg') }}" height="22" />
            </a>

            <a href="{{ route('painel.dashboard') }}" class="logo-dark">
                <img src="{{ Vite::asset('resources/img/painel/logo-dark.svg') }}" height="22" />
            </a>

            <a class="d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class='bx bx-chevron-left bx-sm' ></i>
            </a>
        </div>
    </header>

    <div class="offcanvas-body-lg menu-sidebar py-3 overflow-auto h-100">
        <div class="container-fluid">
            <div class="row gy-1 flex-column flex-grow-1">
                <div class="col">
                    <a href="{{ route('painel.dashboard') }}" class="btn btn-menu {{ $currentRoute == 'painel.dashboard' ? 'active' : '' }}">
                        <i class="bx bx-home"></i>
                        Início
                    </a>
                </div>

                <div class="col">
                    <hr class="border-dark my-2" style="--bs-border-opacity: .40;" />
                </div>

                <div class="col">
                    <a href="{{ route('painel.fornecedores.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.fornecedores.']) ? 'active' : '' }}">
                        <i class="bx bxs-business"></i>
                        Fornecedores
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.pecas.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.pecas.']) ? 'active' : '' }}">
                        <i class="bx bx-cart"></i>
                        Peças
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.usuarios.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.usuarios.']) ? 'active' : '' }}">
                        <i class="bx bx-user-circle"></i>
                        Usuários
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.auditoria.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.auditoria.']) ? 'active' : '' }}">
                        <i class="bx bx-list-check"></i>
                        Auditoria
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.fornecedores-tipos.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.fornecedores-tipos.']) ? 'active' : '' }}">
                        <i class="bx bx-store"></i>
                        Tipos de Fornecedores
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.agrupamentos.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.agrupamentos.']) ? 'active' : '' }}">
                        <i class="bx bx-group"></i>
                        Agrupamentos
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.montadoras.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.montadoras.']) ? 'active' : '' }}">
                        <i class="bx bxs-car"></i>
                        Montadoras
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.modelos.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.modelos.']) ? 'active' : '' }}">
                        <i class="bx bx-package"></i>
                        Modelos
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.marcas.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.marcas.']) ? 'active' : '' }}">
                        <i class="bx bxs-factory"></i>
                        Marcas
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.ceps.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.ceps.']) ? 'active' : '' }}">
                        <i class="bx bx-map-alt"></i>
                        CEPs
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('painel.faqs.index') }}" class="btn btn-menu {{ Str::contains($currentRoute, ['painel.faqs.']) ? 'active' : '' }}">
                        <i class="bx bx-question-mark"></i>
                        FAQs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer-sidebar d-flex align-items-center border-top mt-auto sticky-bottom">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <small class="fw-bold d-block">Logado como:</small>
                    <span>{{ request()->user()->nome }}</span>
                </div>

                <div class="col-auto">
                    {!! Form::open(['url' => route('painel.sair'), 'method' => 'post']) !!}
                        <button class="link-danger p-0 border-0 bg-transparent">
                            <i class='bx bx-sm bx-log-out-circle' ></i>
                        </button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </footer>
</div>
