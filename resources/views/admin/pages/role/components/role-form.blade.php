<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('Role') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to create or change Role record') }}
        </x-slot>
        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <small>{{ __('Name') }}</small>
                <x-jet-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            <livewire:components.inputs.select2
                :selectedData="$this->getPermissionsSelect2Format()"
                isAjax="true"
                isMultiple="true"
                isCustomTemp="true"
                label="{{ __('Permissions list') }}"
                url="{{ route('async.permissions') }}"
                name="permissions" />
            @error('permissions') <span class="text-red-600">{{ $message }}</span> @enderror
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="guard" value="{{ __('Guards list') }}" />
                <select class="form-select" wire:model="guard" name="guard">
                    @foreach(App\Enums\GuardEnums::getValues() as $guard)
                        <option value="{{ $guard }}">{{ $guard }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="name" class="mt-2" />
            </div>
            @error('guard') <span class="text-red-600">{{ $message }}</span> @enderror
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __($button['submit_response']) }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __($button['submit_text']) }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    <x-notify-message on="saved" type="success" :message="__($button['submit_response_notyf'])" />
</div>
