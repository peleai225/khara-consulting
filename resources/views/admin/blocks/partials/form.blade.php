@php($b = $block ?? null)
@php($icons = ['graduation','rocket','users','chart','shield','spark'])
<div class="grid md:grid-cols-2 gap-5">
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Zone <span class="text-khara-red">*</span></label>
        <select name="zone" required class="admin-input">
            @foreach(\App\Models\ContentBlock::ZONES as $v => $label)
                <option value="{{ $v }}" {{ old('zone', $b->zone ?? '') === $v ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-semibold text-khara-slate mb-2">Icône <span class="text-slate-400 font-normal">(piliers)</span></label>
        <select name="icon" class="admin-input">
            <option value="">— Aucune —</option>
            @foreach($icons as $ic)
                <option value="{{ $ic }}" {{ old('icon', $b->icon ?? '') === $ic ? 'selected' : '' }}>{{ ucfirst($ic) }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Titre</label>
    <input type="text" name="title" value="{{ old('title', $b->title ?? '') }}" class="admin-input">
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Texte / description</label>
    <textarea name="subtitle" rows="3" class="admin-input">{{ old('subtitle', $b->subtitle ?? '') }}</textarea>
</div>
<div class="mt-5">
    <label class="block text-sm font-semibold text-khara-slate mb-2">Ordre</label>
    <input type="number" name="order" value="{{ old('order', $b->order ?? 0) }}" class="admin-input max-w-[8rem]">
</div>
<label class="flex items-center gap-2.5 mt-5 text-sm cursor-pointer"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $b->is_active ?? true) ? 'checked' : '' }} class="rounded text-khara-red focus:ring-khara-red border-khara-gray-300">Affiché</label>
<div class="flex gap-3 mt-8"><button class="admin-btn-primary">{{ $b ? 'Enregistrer' : 'Créer' }}</button><a href="{{ route('admin.blocks.index') }}" class="admin-btn-secondary">Annuler</a></div>
