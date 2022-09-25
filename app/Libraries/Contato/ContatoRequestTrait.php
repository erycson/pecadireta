<?php

namespace App\Libraries\Contato;

use App\Libraries\Contato\TipoContato;

trait ContatoRequestTrait
{
    public function contatoRules(): array
    {
        $rules = [
            'contatos'             => 'nullable|array',
            'contatos.*.tipo'      => 'required|in:email,telefone,celular,whatsapp',
            'contatos.*.descricao' => 'nullable|string|max:255',
        ];

        $contatos = $this->contatos ?? [];
        foreach ($contatos as $i => $contato) {
            $rules["contatos.{$i}.contato"] = match ($contato['tipo'] ?? null) {
                TipoContato::Email->value     => 'required|email|max:255',
                TipoContato::Telefone->value  => 'required|telefone_com_ddd|max:255',
                TipoContato::Celular->value   => 'required|celular_com_ddd|max:255',
                TipoContato::WhatsApp->value  => 'required|celular_com_ddd|max:255',
                default                       => 'required|string|max:255'
            };
        }

        return $rules;
    }

    public function contatoAttributes(): array
    {
        $attributes = [
            'contatos.*.tipo' => 'tipo de contato',
            'contatos.*.descricao' => 'descrição',
        ];

        $contatos = $this->contatos ?? [];
        foreach ($contatos as $i => $contato) {
            $attributes["contatos.{$i}.contato"] = 'contato';
        }

        return $attributes;
    }
}

