<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $groups = [
            'general' => 'Paramètres Généraux',
            'email' => 'Configuration Email',
            'seo' => 'SEO',
            'social' => 'Réseaux Sociaux',
            'display' => 'Affichage',
        ];

        $settings = Setting::orderBy('group')->orderBy('order')->get()->groupBy('group');
        $settingsByKey = Setting::all()->keyBy('key');
        
        return view('admin.settings.index', compact('settings', 'groups', 'settingsByKey'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($validated['settings'] as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            
            if ($setting) {
                // Gestion spéciale pour les images
                if ($setting->type === 'image' && $request->hasFile("settings.{$key}")) {
                    // Supprimer l'ancienne image si elle existe
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    
                    $file = $request->file("settings.{$key}");
                    $path = $file->store('settings', 'public');
                    $value = $path;
                }
                
                $setting->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres mis à jour avec succès.');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:settings,key',
            'value' => 'nullable',
            'group' => 'required|string',
            'type' => 'required|string|in:text,textarea,image,email,url,number,boolean',
            'label' => 'required|string',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        Setting::create($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètre créé avec succès.');
    }

    public function destroy(Setting $setting)
    {
        // Supprimer l'image si c'est un paramètre de type image
        if ($setting->type === 'image' && $setting->value && Storage::disk('public')->exists($setting->value)) {
            Storage::disk('public')->delete($setting->value);
        }

        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètre supprimé avec succès.');
    }
}
