@props(['label', 'name', 'type' => 'text'])

<div class="mb-3">
    <label class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" required>
</div>
