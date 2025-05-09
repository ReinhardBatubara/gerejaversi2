@props(['label', 'name'])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" rows="4" class="form-control" required></textarea>
</div>
