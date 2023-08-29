<div id="form-create">
    <x-jet-form-section :submit="$action" class="mb-4">
        <x-slot name="title">
            {{ __('News') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Form to create or change News record') }}
        </x-slot>
        <x-slot name="form">
            <div class="form-group col-span-6 sm:col-span-5">
                <x-jet-label for="title" value="{{ __('Title') }}" />
                <small>{{ __('Title') }}</small>
                <x-jet-input
                    id="title"
                    type="text"
                    class="mt-1 block w-full form-control shadow-none"
                    wire:model.defer="title" />
                <x-jet-input-error for="title" class="mt-2" />
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <label>{{ __('Short') }}</label>
                <textarea wire:model="short" class="mt-1 block w-full form-control shadow-none"></textarea>
            </div>
            <div class="form-group col-span-6 sm:col-span-5">
                <livewire:components.inputs.trix
                    :value="$this->content"/>
            </div>

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
