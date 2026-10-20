<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = ['value', 'label', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('order')->orderBy('id'); }
}
