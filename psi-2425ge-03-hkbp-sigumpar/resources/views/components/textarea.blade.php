@props(['value' => '', 'id' => '', 'name' => '', 'required' => ''])

<textarea 
    id="{{ $id }}" 
    name="{{ $name }}" 
    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" 
    {{ $required ? 'required' : '' }} 
    {{ $attributes }}>
    {{ $value }}
</textarea>
