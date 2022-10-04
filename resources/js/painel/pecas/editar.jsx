import { h, render } from 'preact';
import { useState } from 'preact/hooks';
import AsyncSelect from 'react-select/async';
import AsyncSelectOne from '../../lib/AsyncSelectOne';
import InputFeedback from '../../lib/InputFeedback';
import MoneyInput from '../../lib/MoneyInput';


function Aplicacao({ id, aplicacao, onRemove }) {
    const [tipoVeoculo, setTipoVeoculo] = useState(aplicacao.tipo_veiculo || '');
    const [montadora, setMontadora] = useState(aplicacao.modelo ? {value: aplicacao.modelo.montadora.id, label: aplicacao.modelo.montadora.nome} : {});
    const [modelo, setModelo] = useState(aplicacao.modelo ? {value: aplicacao.modelo.id, label: aplicacao.modelo.nome} : {});
    const [anoDe, setAnoDe] = useState(aplicacao.ano_de || '');
    const [anoAte, setAnoAte] = useState(aplicacao.ano_ate || '');

    const getMontadoraOptions = (q) =>
        fetch(`${MONTADORAS_URL}?q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Selecione'}, ...data])
            .catch(() => []);

    const getModeloOptions = (q) =>
        fetch(`${MODELOS_URL}?montadora=${montadora.value}&q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Selecione'}, ...data])
            .catch(() => []);

    return (
        <div class="row g-3 g-lg-4 mb-3 mb-lg-4 align-items-bottom">
            <div class="col-lg-2">
                <label class="form-label">Tipo de Veículo</label>
                <select class={`form-select w-100 ${ERRORS[`aplicacoes.${id}.tipo_veiculo`] && 'is-invalid'}`} name={`aplicacoes[${id}][tipo_veiculo]`} value={tipoVeoculo} onChange={(e) => setTipoVeoculo(e.target.value)}>
                    <option value="">Selecione</option>
                    <option value="carro">Carro</option>
                    <option value="caminhao">Caminhão</option>
                    <option value="moto">Moto</option>
                </select>
                <InputFeedback for={`aplicacoes.${id}.tipo_veiculo`} />
            </div>

            <div class="col-lg-2">
                <label class="form-label">Montadora</label>
                <AsyncSelect class={ERRORS[`aplicacoes.${id}.montadora_id`] && 'is-invalid'} defaultOptions loadOptions={getMontadoraOptions} value={montadora} onChange={(e) => setMontadora(e)} />
                <input type="hidden" name={`aplicacoes[${id}][montadora_id]`} value={montadora.value} />
                <InputFeedback for={`aplicacoes.${id}.montadora_id`} />
            </div>

            <div class="col-lg-5">
                <label class="form-label">Modelo</label>
                <AsyncSelect class={ERRORS[`aplicacoes.${id}.modelo_id`] && 'is-invalid'} defaultOptions loadOptions={getModeloOptions} value={modelo} onChange={(e) => setModelo(e)} isDisabled={!montadora.value} />
                <input type="hidden" name={`aplicacoes[${id}][modelo_id]`} value={modelo.value} />
                <InputFeedback for={`aplicacoes.${id}.modelo_id`} />
            </div>

            <div class="col-lg-1">
                <label class="form-label">Ano De</label>
                <input type="number" min="1" step="1" name={`aplicacoes[${id}][ano_de]`} class={'form-control ' + (ERRORS[`aplicacoes.${id}.ano_de`] && 'is-invalid')} value={anoDe} onChange={(e) => setAnoDe(e.target.value)} />
                <InputFeedback for={`aplicacoes.${id}.ano_de`} />
            </div>

            <div class="col-lg-1">
                <label class="form-label">Ano Até</label>
                <input type="number" min="1" step="1" name={`aplicacoes[${id}][ano_ate]`} class={'form-control ' + (ERRORS[`aplicacoes.${id}.ano_ate`] && 'is-invalid')} value={anoAte} onChange={(e) => setAnoAte(e.target.value)} />
                <InputFeedback for={`aplicacoes.${id}.ano_ate`} />
            </div>

            <div class="col-lg-auto d-flex">
                <button type="button" class="btn btn-danger rounded-pill mt-auto p-2" onClick={() => onRemove(id)}><i class="bx bx-trash"></i></button>
            </div>
        </div>
    );
}

function Aplicacoes() {
    const [aplicacoes, setAplicacoes] = useState(MODEL.aplicacoes || []);

    function onRemove(index) {
        let novaLista = [...aplicacoes];
        novaLista.splice(index, 1);
        setAplicacoes(novaLista);
    }

    function onAdd() {
        setAplicacoes([
            ...aplicacoes,
            {}
        ]);
    }

    return (
        <div class="card h-100 rounded-3">
            <div class="card-header py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="h6 m-0">Aplicações</span>
                <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" onClick={onAdd}>Adicionar</button>
            </div>

            <div class="card-body px-4">
                {aplicacoes.map((a, i) =>
                    <Aplicacao key={a} id={i} aplicacao={a} onRemove={onRemove} />
                )}
            </div>
        </div>
    );
}

['fornecedor_id', 'marca_id'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {value, url, name} = elemento.dataset;
    render(<AsyncSelectOne value={JSON.parse(value)} url={url} name={name} />, elemento);
});

['preco'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {value, name} = elemento.dataset;
    render(<MoneyInput value={value} name={name} />, elemento);
});


render(<Aplicacoes />, document.getElementById('aplicacoes'));
