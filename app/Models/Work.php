<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'excerpt',
        'cover_image',
    ];

    /**
     * Get the user that owns the work.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ratings for the work.
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get the total number of up ratings.
     */
    public function getUpRatingsAttribute(): int
    {
        return $this->ratings()->where('rating', 'up')->count();
    }

    /**
     * Get the total number of down ratings.
     */
    public function getDownRatingsAttribute(): int
    {
        return $this->ratings()->where('rating', 'down')->count();
    }
}
