<x-admin-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create Admin user') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admins.index') }}">{{ __('Admin users') }}</a></div>
            <div class="breadcrumb-item">Admin user</div>
        </div>
    </x-slot>

    <div>
        <livewire:admin-form action="createAdmin"/>
    </div>
</x-admin-layout>
