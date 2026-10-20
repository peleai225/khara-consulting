@php($p = $program ?? null)
@php($icons = ['graduation','rocket','users','chart','shield','spark'])
<div class="grid md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Titre <span class="text-khara-red">*</span></label>
        <input type="text" name="title" value="{{ old('title', $p->title ?? '') }}" required class="admin-input @error('title') border-khara-red @enderror">
        @error('title')<p class="mt-1 text-sm text-khara-red">{{ $message }}</p>@enderror
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Catégorie <span class="text-khara-red">*</span></label>
        <select name="category" required class="admin-input">
            @foreach(\App\Models\Program::CATEGORIES as $v => $label)
                <option value="{{ $v }}" {{ old('category', $p->category ?? 'domaine') === $v ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Description</label>
    <textarea name="description" rows="3" class="admin-input">{{ old('description', $p->description ?? '') }}</textarea>
</div>
<div class="grid md:grid-cols-2 gap-5 mt-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Icône <span class="text-slate-400 font-normal">(domaines)</span></label>
        <select name="icon" class="admin-input">
            <option value="">— Aucune —</option>
            @foreach($icons as $ic)
                <option value="{{ $ic }}" {{ old('icon', $p->icon ?? '') === $ic ? 'selected' : '' }}>{{ ucfirst($ic) }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Ordre</label>
        <input type="number" name="order" value="{{ old('order', $p->order ?? 0) }}" class="admin-input">
    </div>
</div>
<label class="flex items-center gap-2.5 mt-5 text-sm cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $p->is_active ?? true) ? 'checked' : '' }} class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">Publié</label>
<div class="flex gap-3 mt-8"><button class="admin-btn-primary">{{ $p ? 'Enregistrer' : 'Créer' }}</button><a href="{{ route('admin.programs.index') }}" class="admin-btn-secondary">Annuler</a></div>
