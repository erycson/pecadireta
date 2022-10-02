<x-website.default-layout>
    <!-- Header -->
    <header class="header-page bg-dark py-3 py-lg-4 position-relative">
        <div class="container-xl position-relative" style="z-index: 3;">
            <x-website.header />
        </div>

        <div class="bg-home w-100 h-100 bg-dark position-absolute top-50 start-50 translate-middle d-none"></div>
    </header>

    <!-- Content -->
    <div class="container-xl py-4 my-lg-3">

        <!-- Title -->
        <div class="row g-1 g-lg-3 justify-content-center align-items-center lh-sm mb-4">
            <div class="col-lg-auto"><span class="fw-bold fs-5 mb-0">Resultado da Busca</span></div>
            <div class="col-lg-auto"><span class="fs-5 fw-light text-dark">"Óleo de Câmbio VW"</span></div>
            <div class="col-lg-auto"><span class="fs-5">Encontramos 000 produtos</span></div>
        </div>

        <!-- Filtros -->
        <div class="row gy-3 justify-content-center mb-1 mb-lg-4">
            <div class="col-lg-9">
                <form>
                    <div class="row gy-3 gx-4 justify-content-center mb-3">
                        <div class="col-lg-12">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Caixa Roda Dianteira" aria-label="Caixa Roda Dianteira" aria-describedby="button-addon2">
                                <button class="btn btn-primary px-4" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-outline-primary border border-primary rounded-pill d-flex d-lg-none justify-content-center align-items-center w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <i class='bx bx-filter-alt bx-xs me-1'></i>
                        Filtrar busca
                    </a>

                    <div class="offcanvas-lg offcanvas-end border-0" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header bg-light align-items-center">
                            <h6 class="fw-bold mb-0">
                                Selecione os filtros
                            </h6>
                            <a href="#" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasExample" aria-label="Close"
                                class="link-secondary">
                                <i class='bx bx-x bx-sm d-flex'></i>
                            </a>
                        </div>
                        <div class="offcanvas-body d-flex flex-column">
                            <div class="row gy-3 gx-3 justify-content-center">
                                <div class="col-lg-4">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Tipo de veículo</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Montadora</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Modelo do Veículo</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Estado</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Cidade</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <input class="form-control form-control-sm" type="text" placeholder="CEP" aria-label="default input example">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Ordenação Mobile -->
            <div class="col-lg-auto d-lg-none">
                <p class="fw-bold text-lg-end mb-2">Ordenar lista</p>

                <div class="row gx-2">
                    <div class="col">
                        <div class="dropdown px-0">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Fornecedor
                                <i class='bx bx-down-arrow-alt bx-xs ms-2'></i>
                            </button>
                            <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                <form class="row flex-column">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Todos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Concessionária
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Autopeça
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dropdown px-0">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tipo
                                <i class='bx bx-down-arrow-alt bx-xs ms-2'></i>
                            </button>
                            <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                <form class="row flex-column">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Todos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Genuína
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Alternativa
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label small" for="flexRadioDefault1">
                                                Reuso
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Preço
                            <i class='bx bx-down-arrow-alt bx-xs ms-2'></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <!-- Parts List -->
        {!! $dataTable->table(['class' => 'table-parts w-100 mb-4 mb-lg-5 small']) !!}
    </div>

    <x-website.footer />

    <x-slot:javascripts>
        {!! $dataTable->scripts(null, ['defer', 'type' => 'module']) !!}
        {{-- @vite('resources/js/website/procurar/index.jsx') --}}
    </x-slot>
</x-website.default-layout>
