import { h, render } from 'preact';
import { useState, useRef } from 'preact/hooks';
import InputMask from 'react-input-mask';
import AsyncSelect from 'react-select/async';

function FiltrosPropcurar() {
    const [procurar, setProcurar] = useState('');
    const [tipoVeiculo, setTipoVeiculo] = useState('');
    const [montadora, setMontadora] = useState({value: '', label: 'Montadora'});
    const [modelo, setModelo] = useState({value: '', label: 'Modelo'});
    const [estado, setEstado] = useState('');
    const [minicipio, setMunicipio] = useState({value: '', label: 'Cidade'});
    const [cep, setCep] = useState('');
    const [priceButtonCss, setPriceButtonCss] = useState('bx bx-down-arrow-alt bx-xs ms-2');
    const priceButtonRef = useRef();

    const onProcurarChange = (e) => {
        setProcurar(e.target.value);
        FILTROS.q = e.target.value;
    };

    const onTipoVeiculoChange = (e) => {
        setTipoVeiculo(e.target.value);
        FILTROS.tipos_veiculos = e.target.value;
        TABLE.ajax.reload();
    };

    const onMontadoraChange = (value) => {
        setMontadora(value);
        FILTROS.montadoras = value.value;

        setModelo({value: '', label: 'Modelo'});
        FILTROS.modelos = '';
        TABLE.ajax.reload();
    };

    const onModeloChange = (value) => {
        setModelo(value);
        FILTROS.modelos = value.value;
        TABLE.ajax.reload();
    };

    const onFornecedorTipoChange = (e) => {
        FILTROS.fornecedor_tipo = e.target.value;
        TABLE.ajax.reload();
    };

    const onPecaTipoChange = (e) => {
        FILTROS.peca_tipo = e.target.value;
        TABLE.ajax.reload();
    };

    const onEstadoChange = (e) => {
        setEstado(e.target.value);
        setMunicipio({value: '', label: 'Cidade'});
        FILTROS.uf = e.target.value;
        FILTROS.municipio = '';
        TABLE.ajax.reload();
    };

    const onMunicipioChange = (value) => {
        setMunicipio(value);
        FILTROS.municipio = value.value;
        TABLE.ajax.reload();
    };

    const onCepChange = (e) => {
        setCep(e.target.value);

        if (e.target.value.replaceAll(/[^0-9]+/g, '').length == 8) {
            FILTROS.cep = e.target.value;
            TABLE.ajax.reload();
        }
    };

    const sortByPrice = () => {
        $('#procurarscout-table th:nth-child(5)').trigger('click');
        const css = $('#procurarscout-table th:nth-child(5) i').attr('class');
        setPriceButtonCss(css);
    };

    const onProcurar = () => {
        TABLE.ajax.reload();
        // TABLE.search(procurar).draw();
    };

    const getMontadoraOptions = (q) =>
        fetch(`${MONTADORAS_URL}?q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Montadora'}, ...data])
            .catch(() => []);

    const getModeloOptions = (q) => {
        if (!montadora.value.length) {
            return Promise.resolve([{value: '', label: 'Modelo'}]);
        }

        return fetch(`${MODELOS_URL}?montadora=${montadora.value}&q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Modelo'}, ...data])
            .catch(() => []);
    };

    const getMunicipiosOptions = (q) => {
        if (!estado) {
            return Promise.resolve('');
        }

        return fetch(`${MUNICIPIOS_URL}?estado=${estado}&q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Cidade'}, ...data])
            .catch(() => []);
    };

    return (
        <>
            <div class="col-lg-9">
                <div class="row gy-3 gx-4 justify-content-center mb-3">
                    <div class="col-lg-12">
                        <div class="input-group">
                            <input id="pesquisa" type="text" class="form-control" placeholder="Digite aqui para pesquisar" value={procurar} onChange={onProcurarChange} />
                            <button class="btn btn-primary px-4" type="button" onClick={onProcurar}>Buscar</button>
                        </div>
                    </div>
                </div>

                <a class="btn btn-outline-primary border border-primary rounded-pill d-flex d-lg-none justify-content-center align-items-center w-100" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                    <i class='bx bx-filter-alt bx-xs me-1'></i>
                    Filtrar busca
                </a>

                <div class="offcanvas-lg offcanvas-end border-0" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header bg-light align-items-center">
                        <h6 class="fw-bold mb-0">
                            Selecione os filtros
                        </h6>
                        <a href="#" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasExample" aria-label="Close" class="link-secondary">
                            <i class='bx bx-x bx-sm d-flex'></i>
                        </a>
                    </div>
                    <div class="offcanvas-body d-flex flex-column">
                        <div class="row gy-3 gx-3 justify-content-center">
                            <div class="col-lg-4">
                                <select class="form-select" value={tipoVeiculo} onChange={onTipoVeiculoChange}>
                                    <option value="" selected>Tipo de veículo</option>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                    <option value="caminhao">Caminhão</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <AsyncSelect class="form-select" defaultOptions loadOptions={getMontadoraOptions} value={montadora} onChange={onMontadoraChange} />
                            </div>
                            <div class="col-lg-4">
                                <AsyncSelect class="form-select" defaultOptions loadOptions={getModeloOptions} value={modelo} onChange={onModeloChange} isDisabled={!montadora.value.length} />
                            </div>
                            <div class="col-lg-4">
                                <select class="form-select" value={estado} onChange={onEstadoChange} >
                                    <option value="" selected>Estado</option>\
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <AsyncSelect class="form-select" defaultOptions loadOptions={getMunicipiosOptions} value={minicipio} onChange={onMunicipioChange} isDisabled={!estado.length} />
                            </div>
                            <div class="col-lg-4">
                                <InputMask value={cep} onChange={onCepChange} mask="99.999-999" maskChar="_" class="form-control" placeholder="CEP" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Ordenação Mobile */}
            <div class="col-lg-auto d-lg-none">
                <p class="fw-bold text-lg-end mb-2">Ordenar lista</p>

                <div class="row gx-2">
                    <div class="col">
                        <div class="dropdown px-0">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Fornecedor
                            </button>
                            <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="fornecedor_tipo" value="" checked onChange={onFornecedorTipoChange} />
                                        <label class="form-check-label small">Todos</label>
                                    </div>
                                    {FORNECEDOR_TIPOS.map((tipo) => (
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="fornecedor_tipo" value={tipo.id} onChange={onFornecedorTipoChange} />
                                            <label class="form-check-label small">{tipo.nome}</label>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="dropdown px-0">
                            <button class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tipo
                            </button>
                            <div class="dropdown-menu py-2 px-3 fw-normal border-light shadow-sm" data-popper-placement="bottom-start">
                                <form class="row flex-column">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="todos" checked onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">Todos</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="alternativa" onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">Alternativa</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="genuina" onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">Genuína</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="original" onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">Original</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="after" onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">After</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipo_peca" value="reuso" onChange={onPecaTipoChange} />
                                            <label class="form-check-label small">Reuso</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <button type="button" class="btn btn-sm btn-dark d-flex justify-content-between align-items-center text-nowrap w-100" onClick={sortByPrice} ref={priceButtonRef}>
                            Preço
                            <i class={priceButtonCss}></i>
                        </button>
                    </div>
                </div>
            </div>
        </>
    );
}


const elemento = document.getElementById("filtros");
render(<FiltrosPropcurar />, elemento);
