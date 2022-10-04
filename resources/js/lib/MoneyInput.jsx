import { h, render } from 'preact';
import { useState } from 'preact/hooks';
import CurrencyFormat from 'react-currency-format';

export default function MoneyInput({name, value}) {
    const [valor, setValor] = useState(value.length ? parseFloat(value.match(/[0-9\.\-]+/g)[0]) : '');

    return (
        <>
            <CurrencyFormat class={`form-control ${ERRORS[name] && 'is-invalid'}`} value={valor} onValueChange={({floatValue}) => setValor(isNaN(floatValue) ? '' : floatValue)} displayType={'input'}  thousandSeparator={'.'} decimalSeparator="," prefix={'R$ '} />
            <input type="hidden" name={name} value={valor} />
        </>
    );
}
