

<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="tipo" class="form-label" value="Tipo" />
        <x-form.select class="form-control" name="tipo" :list="['' => 'Selecione', 1 => 'Compradores', 2 => 'Anunciantes']" />
        <x-form.feedback for="tipo" />
    </div>

    <div class="col-lg-8">
        <x-label for="pergunta" class="form-label" value="Pergunta" />
        <x-form.text class="form-control" name="pergunta" />
        <x-form.feedback for="pergunta" />
    </div>

    <div class="col-lg-12">
        <x-label for="resposta" class="form-label" value="Resposta" />
        <x-form.textarea class="form-control" name="resposta" />
        <x-form.feedback for="resposta" />
    </div>
</div>
