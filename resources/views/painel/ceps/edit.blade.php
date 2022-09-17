<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'CEPs', 'painel.ceps.index'], ['title' => 'Editar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Editar CEP</span>
                    </div>
                    <div class="col-auto">
                        {!! Form::model($cep, ['url' => route('painel.ceps.destroy', [$cep]), 'method' => 'delete']) !!}
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Remover</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card h-100 rounded-3">
                    <div class="card-header py-3 px-4">
                        <span class="h6">Editar</span>
                    </div>

                    <div class="card-body px-4">
                        {!! Form::model($cep, ['url' => route('painel.ceps.update', [$cep]), 'class' => 'row g-4 needs-validation', 'novalidate', 'method' => 'put']) !!}
                            @include('painel.ceps.partials._form')

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success rounded-pill px-4">Salvar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:javascripts>
        <script>
            var MODEL = @json($cep, JSON_UNESCAPED_UNICODE);
            var ERRORS = @json(react_error(), JSON_UNESCAPED_UNICODE);
        </script>
        @vite('resources/js/painel/ceps/editar.jsx')
    </x-slot>
</x-painel.dash-layout>
