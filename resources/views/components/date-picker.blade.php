<div
    x-data="{ value : @entangle($attributes->wire('model')) }"
    x-on:change="value = $event.target.value"
    x-init="
        new Pikaday({
        field: $refs.input, 'format': 'MM/DD/YYYY'});"
>
    <div class="relative mt-2">
        <input
            {{ $attributes->whereDoesntStartWith('wire:model') }}
            x-ref="input"
            x-bind:value="value"
            type="text"
            class="form-control" placeholder="Select Day"
        />
    </div>
</div>
