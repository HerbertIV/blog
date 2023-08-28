<x-admin-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create Role') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a></div>
            <div class="breadcrumb-item">Role</div>
        </div>
    </x-slot>

    <div>
        <livewire:role-form action="createRole"/>
    </div>
</x-admin-layout>
