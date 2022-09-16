import { h, render } from 'preact';
import { useState } from 'preact/hooks';
import CurrencyFormat from 'react-currency-format';
import InputFeedback from './InputFeedback';

export default function GeoInput({name, value}) {
    const [lat, setLat] = useState(value.length ? parseFloat(value.match(/[0-9\.\-]+/g)[1]) : '');
    const [lng, setLng] = useState(value.length ? parseFloat(value.match(/[0-9\.\-]+/g)[0]) : '');

    return (
        <>
            <div class="row">
                <div class="col">
                    <label class="form-label">Latitude</label>
                    <CurrencyFormat class={`form-control ${ERRORS[`${name}.latitude`] && 'is-invalid'}`} value={lat} onValueChange={({floatValue}) => setLat(isNaN(floatValue) ? '' : floatValue)} displayType={'input'}  thousandSeparator={false} decimalSeparator="." prefix={''} />
                    <InputFeedback for={`${name}.latitude`} />
                </div>
                <div class="col">
                    <label class="form-label">Longitude</label>
                    <CurrencyFormat class={`form-control ${ERRORS[`${name}.longitude`] && 'is-invalid'}`} value={lng} onValueChange={({floatValue}) => setLng(isNaN(floatValue) ? '' : floatValue)} displayType={'input'}  thousandSeparator={false} decimalSeparator="." prefix={''} />
                    <InputFeedback for={`${name}.longitude`} />
                </div>
                <input type="hidden" name={`${name}[latitude]`} value={lat} />
                <input type="hidden" name={`${name}[longitude]`} value={lng} />
            </div>
        </>
    )
}
