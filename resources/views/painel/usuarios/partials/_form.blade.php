<div class="row g-3 g-lg-4 mb-3 mb-lg-4">
    <div class="col-lg-4">
        <x-label for="fornecedor_id" class="form-label" value="Fornecedor" />
        <x-form.async-select :model="$usuario->fornecedor" route="painel.usuarios.fornecedores" name="fornecedor_id" />
        <x-form.feedback for="fornecedor_id" />
    </div>

    <div class="col-lg-4">
        <x-label for="nome" class="form-label" value="Nome Completo" />
        <x-form.text class="form-control" name="nome" required />
        <x-form.feedback for="nome" />
    </div>

    <div class="col-lg-4">
        <x-label for="email" class="form-label" value="E-mail" />
        <x-form.text class="form-control" name="email" required />
        <x-form.feedback for="email" />
    </div>

    <div class="col-lg-4">
        <x-label for="senha" class="form-label" value="Senha" />
        <x-form.password class="form-control" name="senha" required autocomplete="new-password" />
        <x-form.feedback for="senha" />
    </div>
</div>
