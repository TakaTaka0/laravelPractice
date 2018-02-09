<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{

    public function index() {
      $posts = Post::latest()->get();
      $url = "http://api.openweathermap.org/data/2.5/weather?q=Tokyo,jp&units=metric&appid=b813487fc3b513a73268b3e7e6cdc1f1";
      $json = file_get_contents($url);
      //$results = json_decode($json,true);
      //viewへ渡す、プロパティを複数化


      //カレンダー
      $day =(int)1;
      $datetime = new \DateTime();

    //  $year = datetime->format("Y");
      //dd($posts->toArray();
      //return view('posts.index',['posts'=>$posts]);
      $hash =[
        'posts'=>$posts = Post::latest()->get(),
        'results'=>$results = json_decode($json),
        'week' =>$week =['SUN','MON','TUE','WED','THR','FRY','SAT'],
        'day'=>$day=(int)1,
        'nowTime'=>$nowTime = now(),
        'year'=>$year = (int)$datetime->format("Y"),
        'month'=>$month = (int)$datetime->format("m"),
        'datetime'=>$datetime->setDate($year,$month,$day),
        'firstWeekday'=>$firstWeekday = $datetime->format("w"),
        'lastWeekday'=>$lastWeekday = $datetime->format("t"),
        'cell'=>$cell = (int)42
      ];

      return view('posts.index')->with($hash);

    }

    public function show(Post $post) {
    //$post = Post::findOrFail($id);
    return view('posts.show')->with('post',$post);
    }

    public function create() {
    return view('posts.create');
    }

    public function store(PostRequest $request) {

    // $this->validate($request, [
    //   'title'=> 'required | min:3',
    //   'body' => 'required'
    //
    // ]);

    $post= new Post();
    $post->title = $request->title;
    $post->body = $request->body;
    $post->save();
    return redirect('/');
    }

    public function welcome() {
    return view('posts.welcome');
    }

    public function edit(Post $post) {
    return view('posts.edit')->with('post',$post);
    }

    public function update(PostRequest $request, Post $post) {

    // $this->validate($request, [
    //   'title'=> 'required | min:3',
    //   'body' => 'required'
    //
    // ]);

    $post->title = $request->title;
    $post->body = $request->body;
    $post->save();
    return redirect('/');
    }

    public function destroy(Post $post) {
    $post->delete();
    return redirect('/');
    }

}
