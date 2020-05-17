<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchUrl extends Model
{
    protected $fillable = [
        'web_name',
        'web_url'
    ];
    public function watchable()
    {
        return $this->morphTo();
    }
    public function delete()
    {
        return parent::delete();
    }

    public function setWebNameAttribute($value)
    {
        $this->attributes['web_name'] = ucfirst($value);
    }
}
