<?php

namespace App\Libraries\Usuario;

enum TipoUsuario: string
{
    case Adminstrador = 'administrador';
    case Fornecedor = 'fornecedor';
}
