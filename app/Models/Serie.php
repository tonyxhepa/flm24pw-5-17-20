<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Serie extends Model
{
    use HasSlug, Searchable;

    protected $fillable = [
        'tmdb_id',
        'name',
        'poster_path',
        'created_year'
    ];

    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array =  [
            'id' => $this->id,
            'name'    => $this->name
        ];
        return $array;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class)->latest();
    }
}
