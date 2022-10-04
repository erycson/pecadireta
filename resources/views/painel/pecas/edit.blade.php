<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Peças', 'painel.pecas.index'], ['title' => 'Editar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Editar Peça</span>
                    </div>
                    <div class="col-auto">
                        {!! Form::model($peca, ['url' => route('painel.pecas.destroy', [$peca]), 'method' => 'delete']) !!}
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Remover</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            {!! Form::model($peca, ['url' => route('painel.pecas.update', [$peca]), 'class' => 'row g-4 needs-validation', 'novalidate', 'method' => 'put']) !!}
                <div class="col-12">
                    <div class="card h-100 rounded-3">
                        <div class="card-header py-3 px-4">
                            <span class="h6">Editar</span>
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
            var MODEL = @json($peca, JSON_UNESCAPED_UNICODE);
            var ERRORS = @json(react_error(), JSON_UNESCAPED_UNICODE);
            var MONTADORAS_URL = "{{ route('painel.pecas.montadoras') }}";
            var MODELOS_URL = "{{ route('painel.pecas.modelos') }}";
        </script>
        @vite('resources/js/painel/pecas/editar.jsx')
    </x-slot>
</x-painel.dash-layout>
