<?php

namespace App\Libraries\Contato;

enum TipoContato: string
{
    case Email = 'email';
    case Telefone = 'telefone';
    case Celular = 'celular';
    case WhatsApp = 'whatsapp';

    public function label(): string {
        return match ($this) {
            self::Email => 'E-mail',
            self::Telefone => 'Telefone Fixo',
            self::Celular => 'Celular',
            self::WhatsApp => 'WhatsApp',
        };
    }
}
