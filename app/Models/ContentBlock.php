<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    protected $fillable = ['zone', 'title', 'subtitle', 'icon', 'order', 'is_active'];
    protected $casts = ['is_active' => 'boolean', 'order' => 'integer'];

    public const ZONES = [
        'home_pillar' => 'Accueil — Piliers (bande de preuve)',
        'home_method' => 'Accueil — Notre méthode (étapes)',
        'services_why' => 'Services — Pourquoi Khara',
    ];

    public function scopeActive($q) { return $q->where('is_active', true); }
    public function scopeOrdered($q) { return $q->orderBy('order')->orderBy('id'); }
    public function scopeZone($q, $z) { return $q->where('zone', $z); }
}
