<x-admin-layout>
    <x-slot name="header_content">
        <h1>{{ __('Create News user') }}</h1>

        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('admins.index') }}">{{ __('News') }}</a></div>
            <div class="breadcrumb-item">News</div>
        </div>
    </x-slot>

    <div>
        <livewire:blog-form action="createNews"/>
    </div>
</x-admin-layout>
