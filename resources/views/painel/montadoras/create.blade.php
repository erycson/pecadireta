<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Montadoras', 'painel.montadoras.index'], ['title' => 'Cadastrar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Cadastrar Montadora</span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card h-100 rounded-3">
                    <div class="card-header py-3 px-4">
                        <span class="h6">Cadastrar</span>
                    </div>

                    <div class="card-body px-4">
                        {!! Form::open(['url' => route('painel.montadoras.store'), 'class' => 'row g-4 needs-validation', 'novalidate', 'files' => true]) !!}
                            @include('painel.montadoras.partials._form')

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success rounded-pill px-4">Salvar</button>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-painel.dash-layout>
