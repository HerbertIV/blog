<x-admin-layout>
    <x-slot name="header_content">
        <h1>{{ __('Edit News') }}</h1>

        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></div>
            <div class="breadcrumb-item"><a href="{{ route('blogs.index') }}">{{ __('News') }}</a></div>
            <div class="breadcrumb-item">News</div>
        </div>
    </x-slot>

    <div>
        <livewire:blog-form action="updateNews" :news="$blog"/>
    </div>
</x-admin-layout>
