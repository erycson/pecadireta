<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Fornecedores', 'painel.fornecedores.index'], ['title' => 'Editar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Editar Fornecedor</span>
                    </div>
                    <div class="col-auto">
                        {!! Form::model($fornecedor, ['url' => route('painel.fornecedores.destroy', [$fornecedor]), 'method' => 'delete']) !!}
                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">Remover</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            {!! Form::model($fornecedor, ['url' => route('painel.fornecedores.update', [$fornecedor]), 'class' => 'row g-4 needs-validation', 'novalidate', 'method' => 'put', 'files' => true]) !!}
                <div class="col-12">
                    <div class="card h-100 rounded-3">
                        <div class="card-header py-3 px-4">
                            <span class="h6">Editar</span>
                        </div>

                        <div class="card-body px-4">
                            @include('painel.fornecedores.partials._form')

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success rounded-pill px-4">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <x-form.contatos />
            {!! Form::close() !!}
        </div>
    </div>

    <x-slot:javascripts>
        <script>
            var MODEL = @json(react_model($fornecedor), JSON_UNESCAPED_UNICODE);
            var ERRORS = @json(react_error(), JSON_UNESCAPED_UNICODE);
        </script>
        @vite('resources/js/painel/fornecedores/editar.jsx')
    </x-slot>
</x-painel.dash-layout>
