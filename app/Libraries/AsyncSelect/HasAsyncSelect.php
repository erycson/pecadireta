<?php

namespace App\Libraries\AsyncSelect;

interface HasAsyncSelect
{
    public function toAsyncSelectValue(): array;
}
