<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;


class CommentsController extends Controller
{
    /*
    use を使用して、記述を短くする
    useで指定した、文字列はローディング規約により、ディレクトリ配下として、各プロパティやメソッドを使用可能
    違うcontrollerのアクションにリダイレクトしたい場合
    action('別controller名', $渡したい変数名)
    */
    public function store (Request $request, Post $post) {
      $this->validate($request, [
        'body'=>'required'
      ]);

    $comment = new Comment(['body' => $request->body]);
    $post->comments()->save($comment);
    return redirect()->action('PostsController@show', $post);
  }

    public function destroy (Post $post, Comment $comment) {
     $comment->delete();
     return redirect()->back();

   }
}
