<?php

namespace App\Service;

use App\Contracts\BaseContract;
use App\Service\QueryBuilder;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseService implements BaseContract
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function build(): Model
    {
        return $this->model;
    }

    public function all(
        bool $paginate = false,
        int|null $page = 1,
        int $dataPerPage = 10,
        array $relations = [],
        array $relationCount = [],
        array $whereConditions = [],
        string|null $guard = null,
        string|null $foreignKey = null
    ) {
        try {
            $query = $this->model::query()
                ->with($relations)
                ->orderBy('id', 'DESC');

            foreach ($whereConditions as $condition) {
                if (isset($condition[0], $condition[1], $condition[2])) {
                    if (strtolower($condition[1]) === 'like') {
                        $query->whereRaw('LOWER(' . $condition[0] . ') LIKE ?', [$condition[2]]);
                    } else {
                        $query->where($condition[0], $condition[1], $condition[2]);
                    }
                }
            }

            if (!empty($relationCount)) {
                foreach ($relationCount as $relation) {
                    $query->withCount($relation);
                }
            }

            if ($paginate) {
                $model = $query->latest()->paginate($dataPerPage, ["*"], "page", $page)->withQueryString();
                return [
                    'items' => $model->items(),
                    'prev_page' => (int)mb_substr($model->previousPageUrl(), -1) ?: null,
                    'current_page' => $model->currentPage(),
                    'next_page' => (int)mb_substr($model->nextPageUrl(), -1) ?: null
                ];
            } else {
                return $query->get();
            }
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function getByDateBetween(
        array $dateBetween = [],
        bool $paginate = false,
        int|null $page = 1,
        int $dataPerPage = 10,
        array $relations = [],
        array $whereConditions = []
    ) {
        try {
            $query = $this->model::query()
                ->with($relations)
                ->orderBy('id', 'DESC');

            if (count($dateBetween) == 2) {
                $query->whereDateBetween('created_at', $dateBetween);
            }

            foreach ($whereConditions as $condition) {
                if (isset($condition[0], $condition[1], $condition[2])) {
                    if (strtolower($condition[1]) === 'like') {
                        $query->whereRaw('LOWER(' . $condition[0] . ') LIKE ?', [$condition[2]]);
                    } else {
                        $query->where($condition[0], $condition[1], $condition[2]);
                    }
                }
            }

            if ($paginate) {
                $model = $query->latest()->paginate($dataPerPage, ["*"], "page", $page)->withQueryString();

                return [
                    'data' => $model,
                    'prev_page' => (int)mb_substr($model->previousPageUrl(), -1) ?: null,
                    'current_page' => $model->currentPage(),
                    'next_page' => (int)mb_substr($model->nextPageUrl(), -1) ?: null
                ];
            } else {
                return $query->get();
            }
        } catch (Exception $exception) {
            return $exception;
        }
    }


    public function filter(array $column, array $whereConditions = [], array $relations = [], string $relationCondition = null, array $whereHasConditions = [], bool $eloquentBuilder = false)
    {
        // try {
        //     $query = QueryBuilder::for($this->model::class)
        //         ->allowedFilters($column)
        //         ->with($relations)
        //         ->where($whereConditions);

        //     if (!is_null($relationCondition)) {
        //         $query = $query->whereHas($relationCondition, fn($query) => $query->where($whereHasConditions));
        //     }

        //     return $eloquentBuilder ? $query->latest()->getEloquentBuilder() : $query->latest()->get();
        // } catch (Exception $exception) {
        //     return $exception;
        // }
    }

    public function findById($id, array $relations = [], string|null $guard = null, string|null $foreignKey = null)
    {
        try {
            $query = $this->model::query()
                ->with($relations)
                ->where('id', $id);

            if (!$query->first()) {
                return new Exception(sprintf('Data with id %s not available.', $id));
            }

            return $query->first();
        } catch (Exception $exception) {
            return $exception;
        }
    }

    public function create(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null)
    {
        try {
            if (!is_null($guard) && !is_null($foreignKey)) {
                $authId = Auth::guard($guard)->id();
                $params = array_merge($params, [$foreignKey => $authId]);
            }

            DB::beginTransaction();

            if (!is_null($image)) {
                foreach ($image as $key => $value) {
                    unset($params[$key]);
                }
            }

            $model = $this->model->create($params);

            if (!is_null($image)) {
                foreach ($image as $key => $value) {
                    $model->addMultipleMediaFromRequest([$key])->each(function ($image) use ($key) {
                        $image->toMediaCollection($key);
                    });
                }
            }

            DB::commit();
            return $model->fresh();
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function update($id, array $params, $image = null, string|null $guard = null, string|null $foreignKey = null, $withLog = false)
    {
        try {
            DB::beginTransaction();

            $query = $this->model::findOrFail($id);

            $query->update($params);

            if (!is_null($image)) {
                foreach ($image as $key => $value) {
                    $query->clearMediaCollection();
                    $query->addMultipleMediaFromRequest([$key])->each(function ($image) use ($key) {
                        $image->toMediaCollection($key);
                    });
                }
            }

            if ($withLog) {
                // activity()->performedOn($query)->withProperties($params);
            }

            DB::commit();
            return $query;
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function delete($id, string|null $guard = null, string|null $foreignKey = null)
    {
        try {
            DB::beginTransaction();

            $query = $this->model::query()->where('id', $id);

            // $query = $this->authCheck($query, $guard, $foreignKey);

            if (!$query->first()) {
                return new Exception(sprintf('Data with id %s not available.', $id));
            }

            $query->delete();

            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }

    public function createOrUpdateFirst(array $params, $image = null, string|null $guard = null, string|null $foreignKey = null)
    {
        try {
            DB::beginTransaction();

            $query = $this->model::query()->first();

            if (is_null($query)) {
                $query = $this->create($params, $image, $guard, $foreignKey);
            } else {
                $query->update($params);
            }

            if (!is_null($image)) {
                $query->clearMediaCollection();
                foreach ($image as $key => $value) {
                    $query->addMultipleMediaFromRequest([$key])->each(function ($image) use ($key) {
                        $image->toMediaCollection($key);
                    });
                }
            }

            DB::commit();
            return $query;
        } catch (Exception $exception) {
            DB::rollBack();
            return $exception;
        }
    }
}
