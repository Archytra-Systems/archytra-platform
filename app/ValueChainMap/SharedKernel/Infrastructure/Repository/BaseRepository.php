<?php

namespace App\ValueChainMap\SharedKernel\Infrastructure\Repository;

use App\ValueChainMap\SharedKernel\Domain\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected Model $model
    )
    { }

    public function create(array $data): ?Model {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): ?Model {
        $model = $this->model->whereKey($id)->first();

        if (!$model) {
            return null;
        }
        
        $model->update($data);
        
        return $model;
    }

    public function delete(string $id): bool {
        $model = $this->model->whereKey($id)->first();
        
        if (!$model) {
            return false;
        }

        return $model->delete();
    }
}