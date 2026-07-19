<?php

namespace App\ValueChainMap\SharedKernel\Applications\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class MapTo
{
    public function __construct(
        public readonly string $column_name
    ) {}
}