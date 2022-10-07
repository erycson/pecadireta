<!-- Product Search -->
<div class="bg-dark">
    <div class="container-xl py-5">
        <h2 class="h5 text-center text-white mb-3">Seu produto pesquisado</h2>

        <!-- Parts List -->
        <table class="table-parts w-100 mb-1 mb-lg-4 small" cellpadding="0" role="grid" aria-readonly="true">
            <thead class="text-white text-nowrap">
                <tr>
                    <th id="descricao" class="fw-normal pe-1">
                        <span class="border border-white d-flex rounded-1 py-1 px-2">
                            Código / Descrição
                        </span>
                    </th>

                    <th id="tipo" class="fw-normal pe-1">
                        <span class="border border-white d-flex rounded-1 py-1 px-2">
                            Tipo
                        </span>
                    </th>

                    <th id="estoque" class="fw-normal pe-1">
                        <span class="border border-white d-flex rounded-1 py-1 px-2">
                            Estoque
                        </span>
                    </th>

                    <th id="preco" class="fw-normal pe-1">
                        <span class="border border-white d-flex rounded-1 py-1 px-2">
                            Preço
                        </span>
                    </th>

                    <th id="atualizacao" class="fw-normal pe-1">
                        <span class="border border-white d-flex rounded-1 py-1 px-2">
                            Atualização
                        </span>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr class="bg-white position-relative">
                    <td class="ps-lg-3">
                        <strong class="d-block">{{ $peca->sku }}</strong>
                        {{ $peca->nome }}
                    </td>
                    <td class="text-nowrap">
                        {{ $peca->tipo_peca->label() }}
                    </td>
                    <td>
                        <span class="d-lg-none">Quantidade</span> {{ fmt_integer($peca->estoque) }}
                    </td>
                    <td class="text-nowrap">
                        R$ {{ fmt_money($peca->preco) }}
                        @if ($peca->absoleta) <span class="d-flex align-items-center"><i class="bx bx-timer bx-xs me-1"></i> Obsoleta</span> @endif
                    </td>
                    <td class="text-nowrap">
                        {{ $peca->fornecedor->estoque_atualizado_em?->format('d/m/Y') }}
                        <span class="{{ $peca->fornecedor->atualizacaoCss }} d-flex align-items-center">
                            <i class="bx bx-info-circle bx-xs me-1"></i>
                            {{ $peca->fornecedor->atualizacaoLabel }}
                        </span>
                    </td>
                </tr>

            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-warning px-4">Voltar para a pesquisa</a>
        </div>
    </div>
</div>
