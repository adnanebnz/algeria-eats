<div class="w-full">
    <label for="{{ $id }}" class="block text-sm font-medium leading-6 text-gray-900">{{ $label }}</label>
    <div class="mt-2 w-full">
        <select id="{{ $id }}" name="{{ $name . ($multiple ? '[]' : '') }}"
            wire:model='{{ $name . ($multiple ? '[]' : '') }}' @class([
                'block w-full shadow-sm rounded-md border-0 py-2 ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
                'text-red-900 ring-red-300 focus:ring-red-500' => $errors->has($name),
                'text-gray-900 ring-gray-300 focus:ring-orange-600' => !$errors->has($name),
                'form-select' => !$multiple,
                'form-multiselect' => $multiple,
            ])
            @if ($multiple) multiple @endif>
            <option value="">{{ $placeholder }}</option>
            @foreach ($list as $item)
                <option value="{{ $item->$optionsValues }}" @selected($valueIsCollection ? $value->contains($item->$optionsValues) : $item->$optionsValues == $value)>
                    {{ $item->$optionsSubTexts }} - {{ $item->$optionsTexts }}
                </option>
            @endforeach
        </select>
    </div>

    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror

    @if ($help)
        <p class="mt-2 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>
