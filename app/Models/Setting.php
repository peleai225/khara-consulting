<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'label',
        'description',
        'order',
    ];

    /**
     * Récupérer une valeur de paramètre par sa clé
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Définir une valeur de paramètre
     */
    public static function set($key, $value, $group = 'general', $type = 'text', $label = null, $description = null)
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
                'label' => $label ?? ucfirst(str_replace('_', ' ', $key)),
                'description' => $description,
            ]
        );
    }

    /**
     * Récupérer tous les paramètres d'un groupe
     */
    public static function getGroup($group)
    {
        return static::where('group', $group)->orderBy('order')->get();
    }

    /**
     * Récupérer tous les paramètres sous forme de tableau associatif
     */
    public static function allAsArray()
    {
        return static::pluck('value', 'key')->toArray();
    }
}
