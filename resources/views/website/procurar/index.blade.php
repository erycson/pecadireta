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

        {{-- @if (request()->filled('q'))
            <!-- Title -->
            <div class="row g-1 g-lg-3 justify-content-center align-items-center lh-sm mb-4">
                <div class="col-lg-auto"><span class="fw-bold fs-5 mb-0">Resultado da Busca</span></div>
                <div class="col-lg-auto"><span class="fs-5 fw-light text-dark">"{{ request()->q }}"</span></div>
                <div class="col-lg-auto"><span class="fs-5">Encontramos 000 produtos</span></div>
            </div>
        @endif --}}

        <!-- Filtros -->
        <div class="row gy-3 justify-content-center mb-1 mb-lg-4">

            <div class="col-lg-9" id="filtros"></div>

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
        <script>
            var TABLE = null;
            var FILTROS = {};
            var PROCURAR_URL = "{{ route('website.procurar.index') }}";
            var MONTADORAS_URL = "{{ route('website.procurar.montadoras') }}";
            var MODELOS_URL = "{{ route('website.procurar.modelos') }}";
            var MUNICIPIOS_URL = "{{ route('website.procurar.municipios') }}";
        </script>
        {!! $dataTable->scripts(null, ['defer', 'type' => 'module']) !!}
        @vite('resources/js/website/procurar/index.jsx')
    </x-slot>
</x-website.default-layout>
