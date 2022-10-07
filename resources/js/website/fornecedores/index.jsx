import { h, render } from 'preact';
import { useState, useRef } from 'preact/hooks';

function FiltrosPropcurar() {
    const [procurar, setProcurar] = useState(FILTROS.q || '');
    const [absoleta, isAbsolta] = useState(false);

    const onProcurarChange = (e) => {
        setProcurar(e.target.value);
        FILTROS.q = e.target.value;
    };

    const onAbsoletaChange = (valor) => {
        isAbsolta(valor);
        FILTROS.absoleta = valor;
        TABLE.ajax.reload();
    };

    const onProcurar = () => {
        TABLE.ajax.reload();
        // TABLE.search(procurar).draw();
    };

    return (
        <>
            <div class="row g-2 justify-content-center mb-2 mb-lg-4">
                <div class="col-lg-4">
                    <button onClick={() => onAbsoletaChange(false)} class={`btn btn-outline-primary w-100 ${!absoleta && 'active'}`}>Estoque de Peças</button>
                </div>
                <div class="col-lg-4">
                    <button onClick={() => onAbsoletaChange(true)} class={`btn btn-outline-primary w-100 ${absoleta && 'active'}`}>Estoque de Peças Obsoletas</button>
                </div>
            </div>

            <div class="row gy-3 gx-4 justify-content-center">
                <div class="col-lg-8">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Caixa Roda Dianteira" aria-label="Caixa Roda Dianteira" aria-describedby="button-addon2" value={procurar} onChange={(e) => onProcurarChange(e)} />
                        <button class="btn btn-primary px-4" type="button" onClick={onProcurar}>Buscar</button>
                    </div>
                </div>
            </div>
        </>
    );
}

const elemento = document.getElementById("filtros");
render(<FiltrosPropcurar />, elemento);
