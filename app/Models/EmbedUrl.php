<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmbedUrl extends Model
{
    protected $fillable = [
        'web_name',
        'web_url'
    ];
    public function embedable()
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
