<x-website.default-layout>
    <x-slot:analytics>
        <x-analytics pagina="produto" :fornecedor="$fornecedor->id" />
    </x-slot>

    <!-- Header -->
    <header class="header-page bg-dark py-3 py-lg-4 position-relative">
        <div class="container-xl position-relative" style="z-index: 3;">
            <x-website.header />
        </div>

        <div class="bg-home w-100 h-100 bg-dark position-absolute top-50 start-50 translate-middle d-none"></div>
    </header>

    @include('website.pecas.partials._fornecedor')

    @include('website.pecas.partials._estoque')

    <x-website.footer />

    <x-slot:javascripts>
        <script>
            var TABLE = null;
            @if (request()->filled('q'))
                var FILTROS = {"absoleta":false,"q":"{{ request()->q }}"};
            @else
                var FILTROS = {"absoleta":false};
            @endif
            var FORNECEDOR_TIPOS = @json(\App\Models\FornecedorTipo::get()->map(fn($tipo) => ['id'=> $tipo->id, 'nome'=> $tipo->nome]));
        </script>
        {!! $dataTable->scripts(null, ['defer', 'type' => 'module']) !!}
        @vite('resources/js/website/fornecedores/index.jsx')
    </x-slot>
</x-website.default-layout>
