<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class School extends Model
{

    public static function getName($id)
    {
        return Cache::remember('school_name:' . $id, 600, function () use($id) {
            return self::find($id)->first()->value('name');
        });
    }

    public static function getDefaultId()
    {
        return self::query()->where('is_default', 1)->first()->id;
    }
}
