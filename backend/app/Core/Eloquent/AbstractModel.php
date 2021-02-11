<?php

namespace App\Core\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Core\Eloquent\AbstractModel
 *
 * @mixin Builder
 * @method static Builder|UserAuthenticatable newModelQuery()
 * @method static Builder|UserAuthenticatable newQuery()
 * @method static Builder|UserAuthenticatable query()
 */
abstract class AbstractModel extends Model
{
    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return (new static)->getTable();
    }

    /**
     * Determine if the given relationship (method) exists.
     *
     * @param string $key
     * @return bool
     */
    public function hasRelation(string $key)
    {
        // If the key already exists in the relationships array, it just means the
        // relationship has already been loaded, so we'll just return it out of
        // here because there is no need to query within the relations twice.
        if ($this->relationLoaded($key)) {
            return true;
        }

        // If the "attribute" exists as a method on the model, we will just assume
        // it is a relationship and will load and return results from the query
        // and hydrate the relationship's value on the "relationships" array.
        if (method_exists($this, $key)) {
            //Uses PHP built in function to determine whether the returned object is a laravel relation
            return is_a($this->$key(), "Illuminate\Database\Eloquent\Relations\Relation");
        }

        return false;
    }
}
