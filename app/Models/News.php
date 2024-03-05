<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class News extends Model
{
    protected $fillable = ['title', 'content', 'published_date', 'author_name', 'image_path'];

    public function setPublishedDateAttribute($value)
    {
        $this->attributes['published_date'] = $value ?: Carbon::now();
    }
}
