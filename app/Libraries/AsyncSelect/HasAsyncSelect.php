<?php

namespace App\Libraries\AsyncSelect;

interface HasAsyncSelect
{
    public function toAsyncSelectValue(): array;
    public static function handleAsyncSelectRequest(): \Illuminate\Http\JsonResponse;
}
