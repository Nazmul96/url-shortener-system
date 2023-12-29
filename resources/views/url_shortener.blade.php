<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>URL Shortening</h3>
                    <div class="mt-4" style="width:50%" >
                        <form method="post" action="{{ route('shortener.store') }}">
                            @csrf
                            <label for="base-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Long URL: *</label>
                            <input type="text" name="url" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('url')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                            <x-button class="mt-2">
                            Submit 
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
