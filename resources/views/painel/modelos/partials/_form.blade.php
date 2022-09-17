

<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="montadora_id" class="form-label" value="Montadora" />
        <x-form.async-select :model="$modelo->montadora ?? null" route="painel.modelos.montadoras" name="montadora_id" />
        <x-form.feedback for="montadora_id" />
    </div>

    <div class="col-lg-8">
        <x-label for="nome" class="form-label" value="Nome" />
        <x-form.text class="form-control" name="nome" />
        <x-form.feedback for="nome" />
    </div>
</div>
