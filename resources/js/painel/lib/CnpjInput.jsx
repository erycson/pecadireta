import { h, render } from 'preact';
import { useState } from 'preact/hooks';
import InputMask from 'react-input-mask';

export default function CnpjInput({name, value}) {
    const [data, setData] = useState(value || '');

    let inputValue = data.replaceAll(/[^0-9]+/g, '');
    if (inputValue.length > 0) {
        inputValue = inputValue.padStart(14, '0');
    }

    return (
        <>
            <InputMask value={data} onChange={e => setData(e.target.value)} mask="99.999.999/9999-99" maskChar="_" class="form-control" id={name} />
            <input type="hidden" name={name} value={inputValue} />
        </>
    )
}
