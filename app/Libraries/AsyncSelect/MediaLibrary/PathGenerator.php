<?php

namespace App\Libraries\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as OriginalPathGenerator;
use App\Models\Fornecedor;
use App\Models\Agrupamento;

class PathGenerator implements OriginalPathGenerator
{
	function getPath(Media $media): string
    {
        return match ($media->model_type) {
            Fornecedor::class => sprintf('assets/fornecedores/%d/%d/', $media->model_id, $media->id),
            Agrupamento::class => sprintf('assets/agrupamentos/%d/%d/', $media->model_id, $media->id),
        };
	}

	function getPathForConversions(Media $media): string
    {
        return match ($media->model_type) {
            Fornecedor::class => sprintf('assets/fornecedores/%d/%d/', $media->model_id, $media->id),
            Agrupamento::class => sprintf('assets/agrupamentos/%d/%d/', $media->model_id, $media->id),
        };
	}

	function getPathForResponsiveImages(Media $media): string
    {
        return match ($media->model_type) {
            Fornecedor::class => sprintf('assets/fornecedores/%d/%d/responsive/', $media->model_id, $media->id),
            Agrupamento::class => sprintf('assets/agrupamentos/%d/%d/responsive/', $media->model_id, $media->id),
        };
	}
}
