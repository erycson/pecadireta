<?php

namespace App\Libraries\Contato;

enum TipoContato: string
{
    case Email = 'email';
    case Telefone = 'telefone';
    case Celular = 'celular';
    case WhatsApp = 'whatsapp_cel';
}
