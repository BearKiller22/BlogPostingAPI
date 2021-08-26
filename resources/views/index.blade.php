@if (Auth::check())
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Index') }}
            </h2>
        </x-slot>
        <div class="details" style="display:none">HIDDEN CONTENT</div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    @for ($i = 0; $i < count($AllPosts); $i++)
                    
                    <div class="content">
                            <div class="post">
                                <h1>{{$AllPosts[$i]->author}}</h1>
                                <h1>{{$AllPosts[$i]->title}}</h1>
                                <p>{{$AllPosts[$i]->body}}</p>
                                <img src="postimg" alt="">
                                <h1>Comments:</h1>
                                @if ($AllPosts[$i]->comments != null)

                                    @php
                                        $commentsArray = explode("," ,$AllPosts[$i]->comments);
                                        $CommentAuthorArray = explode("," ,$AllPosts[$i]->CommentAuthor);
                                        $commentsUserID = explode("," ,$AllPosts[$i]->commentsUserID);
                                        $commentsID = explode("," ,$AllPosts[$i]->commentsID);
                                    @endphp
                                   
                                    @for ($j = 0; $j < count($CommentAuthorArray); $j++)
                                        <div class="commentSection">
                                            <h1>{{$CommentAuthorArray[$j]}}</h1>
                                            <h1 class="commentItself">{{$commentsArray[$j]}}</h1>
                                            @if (Auth::user()->id == $commentsUserID[$j])
                                                <a href="{{ route('deleteComment', ['id' => $commentsID[$j] ]) }}"><i class="material-icons">delete</i></a>
                                                <a class="editComment" ><i class="material-icons">edit</i></a>
                                                <form action="editComment" method="post">
                                                    @csrf
                                                    <input hidden="hidden" type="text" value="{{$commentsID[$j]}}" name="commentID">
                                                    <input class="editCommentInput" type="text" value="{{$commentsArray[$j]}}" name="comment">
                                                    <button class="editCommentInput">Edit</button>
                                                </form>
                                            @endif
                                        </div>
                                    @endfor
                                    
                                @endif
                                @if(Auth::check())
                                    <form action="addComment" method="post" class="comments">
                                        @csrf
                                        <input type="text" name='post_id' hidden='hidden' value='{{$AllPosts[$i]->id}}'>
                                        <input type="text" name='body' placeholder="Comment">
                                        <button>></button>
                                    </form>

                                    <div class="vote">
                
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </x-app-layout>
@else 
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        <title>Index</title>
    </head>
    <body>

        <div class="header">

            <div class="logo">
                
            </div>

            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                    @for ($i = 0; $i < count($AllPosts); $i++)
                    
                    <div class="content">
                            <div class="post">
                                <h1>{{$AllPosts[$i]->author}}</h1>
                                <h1>{{$AllPosts[$i]->title}}</h1>
                                <p>{{$AllPosts[$i]->body}}</p>
                                <img src="postimg" alt="">
                                <h1>Comments:</h1>
                                @if ($AllPosts[$i]->comments != null)

                                    @php
                                        $commentsArray = explode("," ,$AllPosts[$i]->comments);
                                        $CommentAuthorArray = explode("," ,$AllPosts[$i]->CommentAuthor);
                                        $commentsUserID = explode("," ,$AllPosts[$i]->commentsUserID);
                                        $commentsID = explode("," ,$AllPosts[$i]->commentsID);
                                    @endphp
                                   
                                    @for ($j = 0; $j < count($CommentAuthorArray); $j++)
                                        <div class="commentSection">
                                            <h1>{{$CommentAuthorArray[$j]}}</h1>
                                            <h1 class="commentItself">{{$commentsArray[$j]}}</h1>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>



        <div class="footer">

        </div>
    </body>
</html>
@endif

<script>
    $( document ).ready(function() {
        $('.editCommentInput').hide();
    });

    $('.editComment').click( function() {
        $('.editCommentInput').show();
        $('.commentItself').hide();
        $('.editComment').hide();
    })
</script>