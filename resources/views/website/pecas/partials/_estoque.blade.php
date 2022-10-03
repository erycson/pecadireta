<!-- Estoque Search -->
<div class="container-xl py-5">
    <h2 class="h5 text-center mb-4">Busque em nosso estoque com <strong>1.186</strong> produtos anunciados</h2>

    <!-- Tab Menu -->
    <div class="row g-2 justify-content-center mb-2 mb-lg-4" id="pills-tab" role="tablist">
        <div class="col-lg-4">
            <button class="btn btn-outline-primary w-100 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Estoque de Peças</button>
        </div>
        <div class="col-lg-4">
            <button class="btn btn-outline-primary w-100" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Estoque de Peças Obsoletas</button>
        </div>
    </div>

    <form>
        <div class="row gy-3 gx-4 justify-content-center mb-3">
            <div class="col-lg-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Caixa Roda Dianteira" aria-label="Caixa Roda Dianteira" aria-describedby="button-addon2">
                    <button class="btn btn-primary px-4" type="button">Buscar</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Tab Content-->
    <div class="tab-content" id="pills-tabContent">

        <!-- Tab Peças -->
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

            <!-- Parts List -->
            <table class="table-parts w-100 mb-4 mb-lg-5 small" cellpadding="0" role="grid" aria-readonly="true">
                <thead class="text-nowrap">
                    <tr>
                        <th id="descricao" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Código / Descrição
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="tipo" class="fw-normal pe-1">
                            <div class="dropdown px-0">
                                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    Tipo
                                    <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                                </button>
                                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                    <form class="row flex-column">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Genuína
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Alternativa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Reuso
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </th>

                        <th id="estoque" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Estoque
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="preco" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Preço
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="atualizacao" class="fw-normal pe-1">
                            <div class="dropdown px-0">
                                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    Atualização
                                    <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                                </button>
                                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                    <form class="row flex-column">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-success" for="flexRadioDefault1">
                                                    Atualizada
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-warning" for="flexRadioDefault1">
                                                    Vencendo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-danger" for="flexRadioDefault1">
                                                    Desatualizada
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <tr class="position-relative">
                        <td class="ps-lg-3">
                            <strong class="d-block">00000000</strong>
                            Parafuso de Radiador de Óleo de Câmbio VW
                        </td>
                        <td class="text-nowrap">
                            Genuína
                        </td>
                        <td>
                            <span class="d-lg-none">Quantidade</span> 0000
                        </td>
                        <td class="text-nowrap">
                            R$ 00.000,00
                            <span class="d-flex align-items-center">
                                <i class="bx bx-timer bx-xs me-1"></i>
                                Obsoleta
                            </span>
                        </td>
                        <td class="text-nowrap">
                            00/00/0000
                            <span class="text-success d-flex align-items-center">
                                <i class="bx bx-info-circle bx-xs me-1"></i>
                                Atualizada
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>

        <!-- Tab Peças Obsoletas -->
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

            <!-- Parts List -->
            <table class="table-parts w-100 mb-4 mb-lg-5 small" cellpadding="0" role="grid" aria-readonly="true">
                <thead class="text-nowrap">
                    <tr>
                        <th id="descricao" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Código / Descrição
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="tipo" class="fw-normal pe-1">
                            <div class="dropdown px-0">
                                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    Tipo
                                    <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                                </button>
                                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                    <form class="row flex-column">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked="">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Genuína
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Alternativa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Reuso
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </th>

                        <th id="estoque" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Estoque
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="preco" class="fw-normal pe-1">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button">
                                Preço
                                <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                            </button>
                        </th>

                        <th id="atualizacao" class="fw-normal pe-1">
                            <div class="dropdown px-0">
                                <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center w-100" type="button" data-bs-toggle="dropdown" aria-expanded="true">
                                    Atualização
                                    <i class="bx bx-down-arrow-alt bx-xs ms-1"></i>
                                </button>
                                <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                    <form class="row flex-column">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                <label class="form-check-label small" for="flexRadioDefault1">
                                                    Todos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-success" for="flexRadioDefault1">
                                                    Atualizada
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-warning" for="flexRadioDefault1">
                                                    Vencendo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label small text-danger" for="flexRadioDefault1">
                                                    Desatualizada
                                                </label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </th>

                    </tr>
                </thead>

                <tbody>
                    <tr class="position-relative">
                        <td class="ps-lg-3">
                            <strong class="d-block">00000000</strong>
                            Parafuso de Radiador de Óleo de Câmbio VW
                        </td>
                        <td class="text-nowrap">
                            Genuína
                        </td>
                        <td>
                            <span class="d-lg-none">Quantidade</span> 0000
                        </td>
                        <td class="text-nowrap">
                            R$ 00.000,00
                            <span class="d-flex align-items-center">
                                <i class="bx bx-timer bx-xs me-1"></i>
                                Obsoleta
                            </span>
                        </td>
                        <td class="text-nowrap">
                            00/00/0000
                            <span class="text-success d-flex align-items-center">
                                <i class="bx bx-info-circle bx-xs me-1"></i>
                                Atualizada
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
