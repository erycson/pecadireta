import { h, render } from 'preact';
import AsyncSelectOne from '../lib/AsyncSelectOne';
import CepInput from '../lib/CepInput';
import CnpjInput from '../lib/CnpjInput';
import GeoInput from '../lib/GeoInput';

['agrupamento_id', 'fornecedor_tipo_id'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {value, url, name} = elemento.dataset;
    render(<AsyncSelectOne value={JSON.parse(value)} url={url} name={name} />, elemento);
});

['cep'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {name, value} = elemento.dataset;
    render(<CepInput name={name} value={value} />, elemento);
});

['cnpj'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {name, value} = elemento.dataset;
    render(<CnpjInput name={name} value={value} />, elemento);
});

['geolocalizacao'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {name, value} = elemento.dataset;
    render(<GeoInput name={name} value={value} />, elemento);
});

