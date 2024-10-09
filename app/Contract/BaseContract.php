<?php

namespace App\Contract;

interface BaseContract
{
    public function all(bool $paginate = false, int $page = 1, int $dataPerPage = 10, array $relations = [], array $relationCount = [], array $whereConditions = [], string|null $guard = null, string|null $foreignKey = null);
    public function getByDateBetween(array $dateBetween = [], bool $paginate = false, int|null $page = 1, int $dataPerPage = 10, array $relations = [], array $whereConditions = []);
    public function filter(array $column, array $whereConditions = [], array $relations = [], string $relationCondition = null, array $whereHasConditions = [], bool $eloquentBuilder = false);
    public function findById($id, array $relations = [], string|null $guard = null, string|null $foreignKey = null);
    public function create(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null);
    public function update($id, array $params, $image = null, string|null $guard = null, string|null $foreignKey = null, $withLog = false);
    public function delete($id, string|null $guard = null, string|null $foreignKey = null);
    public function createOrUpdateFirst(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null);
}