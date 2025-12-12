{{-- With multiple slots, and plugin config parameter --}}
@php
    $config = [
        "placeholder" => "Select multiple options...",
        "allowClear" => true,
    ];
@endphp
<x-adminlte-select2 id="sel2Category" name="sel2Category[]" label="Categories"
    label-class="text-danger" igroup-size="sm" :config="$config" multiple>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-red">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>
    <x-slot name="appendSlot">
        <x-adminlte-button theme="outline-dark" label="Clear" icon="fas fa-lg fa-ban text-danger"/>
    </x-slot>
    <option>Sports</option>
    <option>News</option>
    <option>Games</option>
    <option>Science</option>
    <option>Maths</option>
</x-adminlte-select2>