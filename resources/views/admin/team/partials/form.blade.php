@php($m = $member ?? null)
<div class="grid md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Nom <span class="text-khara-red">*</span></label>
        <input type="text" name="name" value="{{ old('name', $m->name ?? '') }}" required class="admin-input @error('name') border-khara-red @enderror">
        @error('name')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Fonction</label>
        <input type="text" name="role" value="{{ old('role', $m->role ?? '') }}" class="admin-input" placeholder="Ex : Consultante senior">
    </div>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Bio <span class="text-slate-400 font-normal">(optionnel)</span></label>
    <textarea name="bio" rows="3" class="admin-input">{{ old('bio', $m->bio ?? '') }}</textarea>
</div>
<div class="grid md:grid-cols-2 gap-5 mt-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Photo</label>
        @if($m && $m->photo)<img src="{{ asset('storage/'.$m->photo) }}" class="w-20 h-20 rounded-full object-cover mb-2" alt="">@endif
        <input type="file" name="photo" accept="image/*" class="admin-input @error('photo') border-khara-red @enderror">
        @error('photo')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Ordre</label>
        <input type="number" name="order" value="{{ old('order', $m->order ?? 0) }}" class="admin-input">
    </div>
</div>
<label class="flex items-center gap-2.5 mt-5 text-sm cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $m->is_active ?? true) ? 'checked' : '' }} class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">Affiché sur le site</label>
<div class="flex gap-3 mt-8"><button class="admin-btn-primary">{{ $m ? 'Enregistrer' : 'Ajouter' }}</button><a href="{{ route('admin.team.index') }}" class="admin-btn-secondary">Annuler</a></div>
