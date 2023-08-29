<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('User') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to change User record') }}
        </x-slot>

        <x-slot name="form">
            <livewire:components.inputs.select2
                :selectedData="$this->getRolesSelect2Format()"
                isAjax="true"
                isMultiple="true"
                isCustomTemp="true"
                label="{{ __('Roles list') }}"
                url="{{ route('async.roles.blog') }}"
                name="roles" />
            @error('roles') <span class="text-red-600">{{ $message }}</span> @enderror
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
