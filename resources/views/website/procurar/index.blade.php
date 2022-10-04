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
        <div class="row gy-3 justify-content-center mb-1 mb-lg-4" id="filtros"></div>

        <!-- Parts List -->
        {!! $dataTable->table(['class' => 'table-parts w-100 mb-4 mb-lg-5 small']) !!}
    </div>

    <x-website.footer />

    <x-slot:javascripts>
        <script>
            var TABLE = null;
            @if (request()->filled('q'))
                var FILTROS = {"q":"{{ request()->q }}"};
            @else
                var FILTROS = {};
            @endif
            var FORNECEDOR_TIPOS = @json(\App\Models\FornecedorTipo::get()->map(fn($tipo) => ['id'=> $tipo->id, 'nome'=> $tipo->nome]));
            var PROCURAR_URL = "{{ route('website.procurar.index') }}";
            var MONTADORAS_URL = "{{ route('website.procurar.montadoras') }}";
            var MODELOS_URL = "{{ route('website.procurar.modelos') }}";
            var MUNICIPIOS_URL = "{{ route('website.procurar.municipios') }}";
        </script>
        {!! $dataTable->scripts(null, ['defer', 'type' => 'module']) !!}
        @vite('resources/js/website/procurar/index.jsx')
    </x-slot>
</x-website.default-layout>
