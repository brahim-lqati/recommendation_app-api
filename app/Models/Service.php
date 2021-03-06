<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the comments for the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function recommendations() {
        return $this->hasMany(Recommendation::class)->orderByDesc('created_at');
    }

    /**
     * Get the city that owns the Service
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function avgRating($id) {
        dd($id);
        $avg = Service::avg('rating');

    }
}
