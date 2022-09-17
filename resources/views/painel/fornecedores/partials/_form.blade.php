

<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="agrupamento_id" class="form-label" value="Agrupamento" />
        <x-form.async-select :model="$fornecedor->agrupamento ?? null" route="painel.fornecedores.agrupamentos" name="agrupamento_id" />
        <x-form.feedback for="agrupamento_id" />
    </div>

    <div class="col-lg-4">
        <x-label for="fornecedor_tipo_id" class="form-label" value="Tipo" />
        <x-form.async-select :model="$fornecedor->tipo ?? null" route="painel.fornecedores.tipos" name="fornecedor_tipo_id" />
        <x-form.feedback for="fornecedor_tipo_id" />
    </div>

    <div class="col-lg-4">
        <x-label for="cnpj" class="form-label" value="CNPJ" />
        <x-form.cnpj name="cnpj" :value="$fornecedor->cnpj ?? null" />
        <x-form.feedback for="cnpj" />
    </div>

    <div class="col-lg-4">
        <x-label for="url" class="form-label" value="Website" />
        <x-form.text class="form-control" name="url" />
        <x-form.feedback for="url" />
    </div>

    <div class="col-lg-4">
        <x-label for="razao_social" class="form-label" value="Razão Social" />
        <x-form.text class="form-control" name="razao_social" />
        <x-form.feedback for="razao_social" />
    </div>

    <div class="col-lg-4">
        <x-label for="nome_fantasia" class="form-label" value="Nome Fantasia" />
        <x-form.text class="form-control" name="nome_fantasia" />
        <x-form.feedback for="nome_fantasia" />
    </div>

    <div class="col-lg-4">
        <x-label for="cep" class="form-label" value="CEP" />
        <x-form.async-select :model="$fornecedor->cep ?? null" route="painel.fornecedores.ceps" name="cep" />
        <x-form.feedback for="cep" />
    </div>

    <div class="col-lg-4">
        <x-label for="numero" class="form-label" value="Número" />
        <x-form.text class="form-control" name="numero" />
        <x-form.feedback for="numero" />
    </div>

    <div class="col-lg-4">
        <x-label for="complemento" class="form-label" value="Complemento" />
        <x-form.text class="form-control" name="complemento" />
        <x-form.feedback for="complemento" />
    </div>

    <div class="col-lg-4">
        <x-form.geo name="geolocalizacao" :value="$fornecedor->geolocalizacao ?? null" />
    </div>

    <div class="col-lg-4">
        <x-label for="avaliacao_ate" class="form-label" value="Avaliação até" />
        <x-form.date class="form-control" name="avaliacao_ate" />
        <x-form.feedback for="avaliacao_ate" />
    </div>

    <div class="col-lg-4">
        <x-label for="pago_ate" class="form-label" value="Pago até" />
        <x-form.date class="form-control" name="pago_ate" />
        <x-form.feedback for="pago_ate" />
    </div>
</div>
