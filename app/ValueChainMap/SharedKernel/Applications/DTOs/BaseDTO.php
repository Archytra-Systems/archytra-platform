<?php

namespace App\ValueChainMap\SharedKernel\Applications\DTOs;

abstract class BaseDTO
{
    private array $provided_keys = [];

    public static function trackKeys(self $dto, array $data): static {
        $dto->provided_keys = array_keys($data);
        return $dto;
    }

    public static function getProvidedKeys(self $dto): array {
        return $dto->provided_keys;
    }
}