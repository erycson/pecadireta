<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Peças', 'painel.pecas.index'], ['title' => 'Cadastrar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Cadastrar Peça</span>
                    </div>
                </div>
            </div>

            {!! Form::open(['url' => route('painel.pecas.store'), 'class' => 'row g-4 needs-validation', 'novalidate', 'files' => true]) !!}
                <div class="col-12">
                    <div class="card h-100 rounded-3">
                        <div class="card-header py-3 px-4">
                            <span class="h6">Cadastrar</span>
                        </div>

                        <div class="card-body px-4">
                            @include('painel.pecas.partials._form')

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success rounded-pill px-4">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12" id="aplicacoes"></div>
            {!! Form::close() !!}
        </div>
    </div>

    <x-slot:javascripts>
        <script>
            var MODEL = {};
            var ERRORS = @json(react_error(), JSON_UNESCAPED_UNICODE);
            var MONTADORAS_URL = "{{ route('painel.pecas.montadoras') }}";
            var MODELOS_URL = "{{ route('painel.pecas.modelos') }}";
        </script>
        @vite('resources/js/painel/pecas/editar.jsx')
    </x-slot>
</x-painel.dash-layout>
