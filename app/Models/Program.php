<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'category', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public const CATEGORIES = ['domaine' => 'Domaine de formation', 'format' => 'Format'];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('order')->orderBy('id'); }
    public function scopeCategory($q, $c) { return $q->where('category', $c); }
}
