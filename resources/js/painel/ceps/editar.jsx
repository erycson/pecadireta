import { h, render } from 'preact';
import CepInput from '../lib/CepInput';

['cep'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {name, value} = elemento.dataset;
    render(<CepInput name={name} value={value} />, elemento);
});
