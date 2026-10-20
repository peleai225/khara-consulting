<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'hero_title',
        'hero_subtitle',
        'hero_image',
        'content',
        'mission',
        'vision',
        'values',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'values' => 'array', // JSON
    ];

    /**
     * Scope pour les pages actives
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Récupérer une page par son slug
     */
    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->where('is_active', true)->first();
    }
}
