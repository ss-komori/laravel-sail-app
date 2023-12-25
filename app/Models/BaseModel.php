<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    /**
     * @param $attributes
     * @return mixed
     */
    public static function create($attributes)
    {
        $now = new DateTime('now');
        $formedNow = $now->format('Y-m-d H:i:s');
        $attributes['created_at'] = $formedNow;
        $attributes['updated_at'] = $formedNow;
        return (new static)->forwardCallTo((new static)->newQuery(), 'create', [$attributes]);
    }
}
