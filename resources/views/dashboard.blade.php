<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>You're logged  as {{Auth::user()->name}}</h1>
                    <form class="editProfile" action="editProfile" method="post">
                        @csrf
                        <input type="text" name="user_id" hidden="hidden" value="{{Auth::user()->id}}">
                        <input type="text" name="name" id="" value="{{Auth::user()->name}}">
                        <br>
                        <br>
                        <input type="text" name="email" id="" value="{{Auth::user()->email}}">
                        <br>
                        <br>
                        <input type="text" name="password" id="" placeholder="New password">
                        <br>
                        <br>
                        <input type="text" name="repeat" id="repeat" placeholder="Repeat password">
                        <br>
                        <br>
                        <button>Edit You Profile</button>
                        @if (isset($msg))
                            <h1>{{$msg}}</h1>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
