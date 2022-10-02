<?php

namespace App\Libraries\Peca;

enum TipoPeca: string
{
    case Alternativa = 'alternativa';
    case Genuina = 'genuina';
    case Original = 'original';
    case After = 'after';
    case Reuso = 'reuso';

    public function label(): string {
        return match ($this) {
            self::Alternativa => 'Alternativa',
            self::Genuina => 'Genuína',
            self::Original => 'Original',
            self::After => 'After',
            self::Reuso => 'Reuso',
        };
    }
}
