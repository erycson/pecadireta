<!-- Estoque Search -->
<div class="container-xl py-5">
    {{-- <h2 class="h5 text-center mb-4">Busque em nosso estoque com <strong>1.186</strong> produtos anunciados</h2> --}}

    <div class="mb-4" id="filtros"></div>

    <!-- Parts List -->
    {!! $dataTable->table(['class' => 'table-parts w-100 mb-4 mb-lg-5 small', 'cellpadding' => 0, 'role' => 'grid']) !!}
</div>
