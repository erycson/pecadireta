

<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="cep" class="form-label" value="CEP" />
        <x-form.cep name="cep" :value="$cep->cep ?? null" />
        <x-form.feedback for="cep" />
    </div>

    <div class="col-lg-4">
        <x-label for="uf" class="form-label" value="UF" />
        <x-form.text class="form-control" name="uf" />
        <x-form.feedback for="uf" />
    </div>

    <div class="col-lg-4">
        <x-label for="municipio" class="form-label" value="Município" />
        <x-form.text class="form-control" name="municipio" />
        <x-form.feedback for="municipio" />
    </div>

    <div class="col-lg-4">
        <x-label for="bairro" class="form-label" value="Bairro" />
        <x-form.text class="form-control" name="bairro" />
        <x-form.feedback for="bairro" />
    </div>

    <div class="col-lg-4">
        <x-label for="tipo" class="form-label" value="Tipo" />
        <x-form.text class="form-control" name="tipo" />
        <x-form.feedback for="tipo" />
    </div>

    <div class="col-lg-4">
        <x-label for="logradouro" class="form-label" value="Logradouro" />
        <x-form.text class="form-control" name="logradouro" />
        <x-form.feedback for="logradouro" />
    </div>
</div>
