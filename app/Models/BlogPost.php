<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'tags',
        'status',
        'published_at',
        'views',
        'featured',
        'user_id'
    ];

    protected $casts = [
        'tags' => 'array',
        'published_at' => 'datetime',
        'featured' => 'boolean'
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByTag($query, $tag)
    {
        return $query->whereJsonContains('tags', $tag);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    // Accessors & Mutators
    protected function title(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                $this->attributes['slug'] = Str::slug($value);
                return $value;
            }
        );
    }

    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn () => ceil(str_word_count(strip_tags($this->content)) / 200)
        );
    }

    protected function featuredImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->featured_image ? asset('storage/' . $this->featured_image) : null
        );
    }

    protected function tagsString(): Attribute
    {
        return Attribute::make(
            get: fn () => is_array($this->tags) ? implode(', ', $this->tags) : ''
        );
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
