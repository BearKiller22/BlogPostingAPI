<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comments;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class PostsController extends Controller
{

    public function getAll(){
        $AllPosts = DB::select('SELECT 
                                    GROUP_CONCAT(CommentAuthor.id) AS commentsUserID,
                                    GROUP_CONCAT(comments.id) AS commentsID,
                                    GROUP_CONCAT(CommentAuthor.name) AS CommentAuthor,
                                    posts.id,
                                    users.name AS author,
                                    posts.title,
                                    posts.body,
                                    GROUP_CONCAT(comments.body) AS comments
                                FROM posts 
                                LEFT JOIN users ON users.id = posts.user_id
                                LEFT JOIN comments ON comments.post_id = posts.id
                                LEFT JOIN users AS CommentAuthor ON comments.user_id = CommentAuthor.id
                                GROUP BY posts.id
                                ORDER BY posts.created_at DESC   
        ');
        return $AllPosts; //This is For an API   
        return view('index', compact('AllPosts')); // This is For a Web version
    }

    public function create(){
        return view('create');
    }



    public function getUserPosts($id){
        $AllPosts = DB::select('SELECT 
            GROUP_CONCAT(CommentAuthor.name) AS CommentAuthor,
            posts.id,
            users.name AS author,
            posts.title,
            posts.body,
            GROUP_CONCAT(comments.body) AS comments
            FROM posts 
            LEFT JOIN users ON users.id = posts.user_id
            LEFT JOIN comments ON comments.post_id = posts.id
            LEFT JOIN users AS CommentAuthor ON comments.user_id = CommentAuthor.id
            WHERE posts.user_id = ?
            GROUP BY posts.id
            ORDER BY posts.created_at DESC',
            
            [ $id ]
            );
        return $AllPosts;
        return view('myposts', compact('AllPosts'));
    }

    public function upload(Request $request){
        
        $posts = new Post;
        $posts->title = $request->title;
        // $posts->user_id = Auth::user()->id;
        $posts->user_id = $request->user_id; // For an API
        $posts->body = $request->body;
        $posts->save();
        return $request;

        // return view('create');
    }

    public function edit(Request $request){
        $post = Post::find($request->post_id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();
        return ['message' => 'post edited'];
        // return redirect('myposts');
    }

    public function delete($id){
        $post = Post::find($id);
        $post->delete();
        return ['message' => 'Post Deleted'];
        // return $this->getUserPosts();
    }

    public function addComment(Request $request){
        $comment = new Comments;
        // $comment->user_id = Auth::id();
        $comment->user_id = $request->user_id; // For an API
        $comment->post_id = $request->post_id;
        $comment->body = $request->body;
        $comment->save();
        return ['message' => 'Comment Added'];
        return redirect('index');
    }

    public function deleteComment($id){
        $post = Comments::find($id);
        $post->delete();
        return ['message' => 'Comment Deleted']; // THis is For an API
        return redirect('index'); // This is For a Web version
    }

    public function editComment(Request $request){
        $post = Comments::find($request->commentID);
        $post->body = $request->comment;
        $post->save();
        return ['message' => 'Comment With id =>'. $request->commentID. ' Edited']; // THis is For an API

        return redirect('index'); // This is For a Web version
    }
}
