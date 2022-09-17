import { h, render } from 'preact';
import AsyncSelectOne from '../lib/AsyncSelectOne';

['montadora_id'].forEach(elementoId => {
    const elemento = document.getElementById(elementoId);
    const {value, url, name} = elemento.dataset;
    render(<AsyncSelectOne value={JSON.parse(value)} url={url} name={name} />, elemento);
});
