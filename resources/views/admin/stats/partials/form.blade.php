@php($s = $stat ?? null)
<div class="grid md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Valeur <span class="text-khara-red">*</span></label>
        <input type="text" name="value" value="{{ old('value', $s->value ?? '') }}" required class="admin-input @error('value') border-khara-red @enderror" placeholder="Ex : 200+">
        @error('value')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Ordre</label>
        <input type="number" name="order" value="{{ old('order', $s->order ?? 0) }}" class="admin-input">
    </div>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Libellé <span class="text-khara-red">*</span></label>
    <input type="text" name="label" value="{{ old('label', $s->label ?? '') }}" required class="admin-input @error('label') border-khara-red @enderror" placeholder="Ex : Entreprises accompagnées">
    @error('label')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
</div>
<label class="flex items-center gap-2.5 mt-5 text-sm cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $s->is_active ?? true) ? 'checked' : '' }} class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">Affiché sur le site</label>
<div class="flex gap-3 mt-8"><button class="admin-btn-primary">{{ $s ? 'Enregistrer' : 'Ajouter' }}</button><a href="{{ route('admin.stats.index') }}" class="admin-btn-secondary">Annuler</a></div>
