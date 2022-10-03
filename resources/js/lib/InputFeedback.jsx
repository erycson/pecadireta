import { h, render } from 'preact';

export default function InputFeedback(props) {
    if (!ERRORS[props.for]) {
        return null;
    }

    return <div class="invalid-feedback">{ERRORS[props.for]}</div>;
}
