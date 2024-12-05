<?php
namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Model;



trait LoadRelationShips
{

    public function loadOptionalRelations(
        Model|QueryBuilder|EloquentBuilder|HasMany|BelongsToMany|BelongsTo $model,
        ?array $relations = null
        ): Model|QueryBuilder|EloquentBuilder|HasMany|BelongsToMany|BelongsTo {
            $relations = $relations ?? $this->relations ?? [];
            foreach ($relations as $relation) {
               $model->when(
                    $this->shouldIncludeRelationships( relation:$relation),
                    fn($q) =>$model instanceof Model ? $model->load($relation) : $q->with($relation)
                );
            }

            return $model;
    }

    protected function shouldIncludeRelationships(string $relation) {
        $queryParam = $this->defaultQueryParam ?? 'include';
        $include = request()->query($queryParam);
        if(!$include) {
            return false;
        }
        $relations = array_map('trim', explode(',', $include));
        return in_array($relation, $relations);
    }
}
