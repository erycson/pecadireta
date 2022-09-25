import { h, render } from 'preact';
import AsyncSelectOne from '../lib/AsyncSelectOne';
import CnpjInput from '../lib/CnpjInput';
import GeoInput from '../lib/GeoInput';
import Contatos from '../lib/Contatos';

['agrupamento_id', 'fornecedor_tipo_id', 'cep'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {value, url, name} = elemento.dataset;
    render(<AsyncSelectOne value={JSON.parse(value)} url={url} name={name} />, elemento);
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

render(<Contatos />, document.getElementById('contatos'));
