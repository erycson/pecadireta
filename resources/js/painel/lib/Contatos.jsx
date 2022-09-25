import { h, render, Component } from 'preact';
import { useState } from 'preact/hooks';
import InputMask from 'react-input-mask';
import InputFeedback from './InputFeedback';

class ContatoInput extends Component {
    constructor(props) {
        super(props);
        this.state = {
            tipo: props.tipo || '',
            value: props.value || '',
            onChange: props.onChange || ''
        }
    }

    componentDidUpdate() {
        if (this.props.tipo != this.state.tipo) {
            this.setState({tipo: this.props.tipo});
        } else if (this.props.value != this.state.value) {
            this.setState({value: this.props.value});
        }
    }

    render() {
        const { tipo, value, onChange } = this.state;
        const cssClass = `form-control ${ERRORS[this.props.for] && 'is-invalid'}`;

        if (tipo == 'email') {
            return <input type="email" class={cssClass} name="contatos[][contato]" value={value} onChange={onChange}/>;
        } else if (tipo == 'telefone') {
            return <InputMask class={cssClass} value={value} onChange={onChange} mask="(99) 9999-9999" maskChar="_" />;
        } else if (tipo == 'celular' || tipo == 'whatsapp') {
            return <InputMask class={cssClass} value={value} onChange={onChange} mask="(99) 9.9999-9999" maskChar="_" />;
        } else {
            return <input type="text" class={cssClass} disabled />;
        }
    }
}

function Contato({ id, tipo, contato, descricao, ordem, onRemove }) {
    const [tipoVal, setTipo] = useState(tipo || '');
    const [contatoVal, setContato] = useState(contato || '');
    const [descricaoVal, setDescricao] = useState(descricao || '');

    const ontTipoChange = (valor) => {
        setTipo(valor);
        setContato('');
    };

    return (
        <div class="row g-3 g-lg-4 mb-3 mb-lg-4 align-items-bottom">
            <div class="col-lg">
                <label class="form-label">Tipo de Contato</label>
                <select class={`form-select w-100 ${ERRORS[`contatos.${id}.tipo`] && 'is-invalid'}`} name={`contatos[${id}][tipo]`} value={tipoVal} onChange={(e) => ontTipoChange(e.target.value)}>
                    <option value="">Selecione</option>
                    <option value="email">E-mail</option>
                    <option value="telefone">Telefone Fixo</option>
                    <option value="celular">Celular</option>
                    <option value="whatsapp"> WhatsApp</option>
                </select>
                <InputFeedback for={`contatos.${id}.tipo`} />
            </div>

            <div class="col-lg-3">
                <label class="form-label">Contato</label>
                <ContatoInput for={`contatos.${id}.contato`} tipo={tipoVal} value={contatoVal} onChange={(e) => setContato(e.target.value)} />
                <InputFeedback for={`contatos.${id}.contato`} />
                <input type="hidden" name={`contatos[${id}][contato]`} value={contatoVal} />
            </div>

            <div class="col-lg-4">
                <label class="form-label">Descrição</label>
                <input type="text" class={`form-control ${ERRORS[`contatos.${id}.descricao`] && 'is-invalid'}`} name={`contatos[${id}][descricao]`} value={descricaoVal} onChange={(e) => setDescricao(e.target.value)} />
                <InputFeedback for={`contatos.${id}.descricao`} />
            </div>

            <div class="col-lg-auto d-flex">
                <button type="button" class="btn btn-danger rounded-pill mt-auto p-2" onClick={() => onRemove(id)}><i class="bx bx-trash"></i></button>
            </div>
        </div>
    );
}

export default function Contatos() {
    const [contatos, setContatos] = useState(MODEL.contatos || []);

    function onRemove(index) {
        let novaLista = [...contatos];
        novaLista.splice(index, 1);
        setContatos(novaLista);
    }

    function onAdd() {
        setContatos([
            ...contatos,
            {}
        ]);
    }

    return (
        <div class="card h-100 rounded-3">
            <div class="card-header py-3 px-4 d-flex justify-content-between align-items-center">
                <span class="h6 m-0">Contatos</span>
                <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" onClick={onAdd}>Adicionar</button>
            </div>

            <div class="card-body px-4">
                {contatos.map((c, i) =>
                    <Contato key={c} id={i} tipo={c.tipo} contato={c.contato} descricao={c.descricao} onRemove={onRemove} />
                )}
            </div>
        </div>
    );
}
