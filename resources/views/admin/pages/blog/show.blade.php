<x-admin-layout>
    <x-slot name="header_content">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">

            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <a class="btn btn-info text-sm text-white-600 hover:text-white-900" href="{{ route('blogs.index') }}">
                    {{ __('Back') }}
                </a>
                @if (auth()->guard(\App\Enums\GuardEnums::ADMIN)->user()->hasPermissionFromGuard('blog' . \App\Enums\PermissionEnums::HYPHEN . \App\Enums\PermissionEnums::UPDATE_ACTION))
                    <a class="btn btn-info text-sm text-white-600 hover:text-white-900" href="{{ route('blogs.edit', $blog) }}">
                        {{ __('Edit') }}
                    </a>
                @endif
            </div>

            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Title') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <strong>{{ $blog->title }}</strong>
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Short') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $blog->short !!}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Content') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {!! $blog->content !!}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

    </div>

</x-admin-layout>

