<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Peças']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">

            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Peças</span>
                    </div>

                    <div class="col-auto">
                        <a href="{!! route('painel.pecas.create') !!}" class="btn btn-sm btn-success rounded-pill px-3">Cadastrar</a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card h-100 rounded-3">
                    <div class="card-header py-3 px-4">
                        <span class="h6">Lista de Peças</span>
                    </div>

                    <div class="card-body px-4">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:javascripts>
        {!! $dataTable->scripts(null, ['defer', 'type' => 'module']) !!}
    </x-slot>
</x-painel.dash-layout>
