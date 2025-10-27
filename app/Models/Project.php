<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'short_description',
        'image',
        'gallery',
        'technologies',
        'project_url',
        'github_url',
        'demo_url',
        'status',
        'completion_date',
        'featured',
        'order',
        'active'
    ];

    protected $casts = [
        'gallery' => 'array',
        'technologies' => 'array',
        'completion_date' => 'date',
        'featured' => 'boolean',
        'active' => 'boolean'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }

    public function scopePublished($query)
    {
        return $query->where('active', true);
    }

    // Accessors
    protected function technologiesString(): Attribute
    {
        return Attribute::make(
            get: fn () => is_array($this->technologies) ? implode(', ', $this->technologies) : ''
        );
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->image ? asset('storage/' . $this->image) : null
        );
    }
}
