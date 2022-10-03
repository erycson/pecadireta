import { h, render } from 'preact';
import { useState } from 'preact/hooks';
import AsyncSelect from 'react-select/async';

export default function AsyncSelectOne({value, url, name}) {
    const [item, setItem] = useState(value || {});

    const getOptions = (q) =>
        fetch(`${url}?q=${q}`, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => [{value: '', label: 'Selecione'}, ...data])
            .catch(() => []);

    return (
        <>
            <AsyncSelect class={ERRORS[name] && 'is-invalid'} defaultOptions loadOptions={getOptions} value={item} onChange={(e) => setItem(e)} />
            <input type="hidden" name={name} value={item.value} />
        </>
    );
}
