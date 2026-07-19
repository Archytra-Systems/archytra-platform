<?php

namespace App\ValueChainMap\SharedKernel\Domain\Repository;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $data): ?Model;
    public function update(string $id, array $data): ?Model;
    public function delete(string $id): bool;
}