<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Create Post!
                </div>
                <form method="POST" action="{{ route('upload') }}">
                    @csrf
        
                    <!-- Name -->
                    <div>
                        <x-label for="title" :value="__('Title')" />
        
                        <x-input id="titleame" class="block mt-1 w-half" type="text" name="title" required autofocus />
                    </div>
        
        
                    <!-- Password -->
                    <div>
                        <x-label for="body" :value="__('Body')" />
        
                        <x-input id="body" class="block mt-1 w-half" type="text" name="body" required autofocus />
                    </div>
        
                    <div class="flex items-center justify-center mt-4">
    
                        <x-button class="ml-4">
                            {{ __('Upload') }}
                        </x-button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</x-app-layout>
