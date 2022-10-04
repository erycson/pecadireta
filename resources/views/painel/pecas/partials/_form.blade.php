

<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="sku" class="form-label" value="Código da Peça" />
        <x-form.text class="form-control" name="sku" />
        <x-form.feedback for="sku" />
    </div>

    <div class="col-lg-8">
        <x-label for="nome" class="form-label" value="Nome" />
        <x-form.text class="form-control" name="nome" />
        <x-form.feedback for="nome" />
    </div>

    <div class="col-lg-4">
        <x-label for="tipo_peca" class="form-label" value="Tipo de Peça" />
        <x-form.select class="form-control" name="tipo_peca" :valor="$peca->tipo_peca?->value" :list="['genuina' => 'Genuína', 'original' => 'Original', 'alternativa' => 'Alternativa', 'after' => 'After', 'reuso' => 'Reuso']" />
        <x-form.feedback for="tipo_peca" />
    </div>

    <div class="col-lg-4">
        <x-label for="fornecedor_id" class="form-label" value="Fornecedor" />
        <x-form.async-select :model="$peca->fornecedor ?? null" route="painel.pecas.fornecedores" name="fornecedor_id" />
        <x-form.feedback for="fornecedor_id" />
    </div>

    <div class="col-lg-4">
        <x-label for="marca_id" class="form-label" value="Marca" />
        <x-form.async-select :model="$peca->marca ?? null" route="painel.pecas.marcas" name="marca_id" />
        <x-form.feedback for="marca_id" />
    </div>

    <div class="col-lg-4">
        <x-label for="estoque" class="form-label" value="Estoque" />
        <x-form.number class="form-control" name="estoque" min="1" step="1" />
        <x-form.feedback for="estoque" />
    </div>

    <div class="col-lg-4">
        <x-label for="preco" class="form-label" value="Preço" />
        <x-form.money name="preco" :value="$peca?->preco" />
        <x-form.feedback for="preco" />
    </div>

    <div class="col-lg-4">
        <x-label for="absoleta" class="form-label" value="Absoleta" />
        <x-form.select class="form-control" name="absoleta" :valor="intval($peca?->absoleta)" :list="['0' => 'Não', '1' => 'Sim']" />
        <x-form.feedback for="absoleta" />
    </div>
</div>
