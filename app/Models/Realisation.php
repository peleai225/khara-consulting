<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Realisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'sector', 'client', 'summary',
        'challenge', 'solution', 'result', 'image', 'order', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (Realisation $r) {
            if (empty($r->slug)) {
                $r->slug = Str::slug($r->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at', 'desc');
    }
}
