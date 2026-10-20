@php($r = $realisation ?? null)

<div class="grid md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Titre <span class="text-khara-red">*</span></label>
        <input type="text" name="title" value="{{ old('title', $r->title ?? '') }}" required class="admin-input @error('title') border-khara-red @enderror">
        @error('title')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Slug <span class="text-slate-400 font-normal">(auto si vide)</span></label>
        <input type="text" name="slug" value="{{ old('slug', $r->slug ?? '') }}" class="admin-input @error('slug') border-khara-red @enderror">
        @error('slug')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Secteur</label>
        <input type="text" name="sector" value="{{ old('sector', $r->sector ?? '') }}" class="admin-input" placeholder="Ex : PME agroalimentaire">
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Client <span class="text-slate-400 font-normal">(optionnel)</span></label>
        <input type="text" name="client" value="{{ old('client', $r->client ?? '') }}" class="admin-input">
    </div>
</div>

<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Résumé <span class="text-slate-400 font-normal">(carte accueil)</span></label>
    <textarea name="summary" rows="2" class="admin-input">{{ old('summary', $r->summary ?? '') }}</textarea>
</div>

<div class="grid md:grid-cols-3 gap-5 mt-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Le défi</label>
        <textarea name="challenge" rows="4" class="admin-input">{{ old('challenge', $r->challenge ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">La solution</label>
        <textarea name="solution" rows="4" class="admin-input">{{ old('solution', $r->solution ?? '') }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Les résultats</label>
        <textarea name="result" rows="4" class="admin-input">{{ old('result', $r->result ?? '') }}</textarea>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-5 mt-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Image</label>
        @if($r && $r->image)
            <img src="{{ asset('storage/' . $r->image) }}" alt="" class="w-28 h-20 object-cover rounded-lg mb-2">
        @endif
        <input type="file" name="image" accept="image/*" class="admin-input @error('image') border-khara-red @enderror">
        @error('image')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Ordre d'affichage</label>
        <input type="number" name="order" value="{{ old('order', $r->order ?? 0) }}" class="admin-input">
    </div>
</div>

<label class="flex items-center gap-2.5 mt-5 text-sm text-khara-slate cursor-pointer">
    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $r->is_active ?? true) ? 'checked' : '' }} class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">
    Publiée (visible sur le site)
</label>

<div class="flex items-center gap-3 mt-8">
    <button type="submit" class="admin-btn-primary">{{ $r ? 'Enregistrer' : 'Créer' }}</button>
    <a href="{{ route('admin.realisations.index') }}" class="admin-btn-secondary">Annuler</a>
</div>
