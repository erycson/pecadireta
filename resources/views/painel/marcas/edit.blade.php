<x-painel.dash-layout>
    <x-breadcrumb :items="[['title' => 'Marcas', 'painel.marcas.index'], ['title' => 'Editar']]" />

    <div class="container-fluid px-xl-5 py-3 py-lg-4 h-100">
        <div class="row g-3 g-lg-4">
            <div class="col-12">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <span class="h4">Editar Marca</span>
                    </div>
                    <div class="col-auto">
                        {!! Form::model($marca, ['url' => route('painel.marcas.destroy', [$marca]), 'method' => 'delete']) !!}
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
                        {!! Form::model($marca, ['url' => route('painel.marcas.update', [$marca]), 'class' => 'row g-4 needs-validation', 'novalidate', 'method' => 'put', 'files' => true]) !!}
                            @include('painel.marcas.partials._form')

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
