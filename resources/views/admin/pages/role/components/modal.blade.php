<x-confirmation-modal wire:model="confirmingUserDeletion">
    <x-slot name="title">
        Delete role
    </x-slot>

    <x-slot name="content">
        Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted.
    </x-slot>

    <x-slot name="footer">
        <x-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
            Cancel
        </x-secondary-button>

        <x-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
            Delete
        </x-danger-button>
    </x-slot>
</x-confirmation-modal>
