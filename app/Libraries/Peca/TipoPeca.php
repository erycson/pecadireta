<?php

namespace App\Libraries\Peca;

enum TipoPeca: string
{
    case Alternativa = 'alternativa';
    case Genuina = 'genuina';
    case Original = 'original';
    case After = 'after';
    case Reuso = 'reuso';
}
