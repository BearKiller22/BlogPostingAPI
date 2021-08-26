<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Your Posts Are Here;
                    @for ($i = 0; $i < count($AllPosts); $i++)
                        <div class="content">
                            <div class="post">
                                <h1>Edit Your Post</h1>
                                <form action="edit" method="get" class="editForm">
                                    @csrf
                                    <div class="post-inner-box">
                                        <p>Title -> </p>
                                        <input type="text" name="title" value="{{$AllPosts[$i]->title}}" placeholder="Title">
                                    </div>
    
                                    <div class="post-inner-box">
                                        <p>Body -> </p>
                                        <input type="text" name="body" value="{{$AllPosts[$i]->body}}" placeholder="Body">
                                    </div>
                                    <input type="text" hidden="hidden" name="post_id" value="{{$AllPosts[$i]->id}}">
                                    <button>Edit</button>
                                    <a href="{{ route('delete', ['id' => $AllPosts[$i]->id]) }}">Delete</a>
                                </form>

                                <img src="postimg" alt="">
                                <br><br>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>


