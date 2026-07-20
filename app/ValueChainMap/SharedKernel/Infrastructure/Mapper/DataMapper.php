<?php

namespace App\ValueChainMap\SharedKernel\Infrastructure\Mapper;

use App\ValueChainMap\SharedKernel\Applications\Attribute\MapTo;
use App\ValueChainMap\SharedKernel\Applications\DTOs\BaseDTO;
use ReflectionClass;

final class DataMapper {
    public static function toDatabase(object $dto, array $exclude_column = []): array {
        $data = [];
        $reflection = new ReflectionClass($dto);

        $tracked_keys = $dto instanceof BaseDTO;
        $provided_keys = $tracked_keys ? BaseDTO::getProvidedKeys($dto) : [];

        foreach ( $reflection->getProperties() as $property ) {
            $name = $property->getName();

            if ( $tracked_keys && !empty($provided_keys) && !in_array($name, $provided_keys) ) {
                continue;
            }

            if ( in_array($name, $exclude_column) ) {
                continue;
            }

            $value = $property->getValue($dto);
            
            $attributes = $property->getAttributes(MapTo::class);
            if (!empty($attributes)) {
                $column = $attributes[0]->newInstance()->column_name; 
                $data[$column] = $value;
            } else {
                $data[$name] = $value;
            }
        }

        return $data;
    }
}