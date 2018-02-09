@extends('layouts.default')

@section('title', 'Blog Posts')

@section('content')
<h1>
  Blog Posts
  <a href="{{ url('/posts/create') }}" class="header-menu">New Post</a>
  <a href="{{ url('/posts/welcome') }}" class="header-menu">Welcome</a>
</h1>
<!-- <ul id="coverUl"> -->
  @forelse ($posts as $post)
  <li id="postsList">
    <a class="detailAtag" href="{{ action('PostsController@show', $post) }}">{{ $post->title }}</a>
    <a href="{{ action('PostsController@edit', $post) }}" class="detailAtag edit">[Edit]</a>
    <a href="#" class="detailAtag del" data-id="{{ $post->id }}">[x]</a>
    <form method="post" action="{{ url('/posts', $post->id) }}" id="form_{{ $post->id }}">
      {{ csrf_field() }}
      {{ method_field('delete') }}
    </form>
  </li>
  @empty
  <li>No posts yet</li>
  @endforelse
<!-- </ul> -->

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/js/main.js"></script>
<script src="/js/calendar.js"></script>
@endsection

<div class="sidebar">
<div id="weatherSection">
  <ul>
    <h3>Weather Repport</h3>
    <li>Location:{{$results->name}}</li>
    <li>Condition:{{$results->weather[0]->description}}</li>
    <li>Temperature:{{$results->main->temp}}</li>
    <li>etc</li>
  </ul>
</div>

<table id="calendarTable">
@foreach ($week as $val)
  <th>{{$val}}</th>
@endforeach

<tr>
@for ($i=0; $i<$firstWeekday; $i++)
  <td></td>
@endfor

@for ($cell=$firstWeekday; $cell<=42; $cell++)
  @if ($cell%7 === 0)
    <tr></tr>
  @endif

  @if ($day<=$lastWeekday)
    <td id="eachDay">{{++$day-1}}</td>
  @endif
@endfor
</tr>
</table>
</div>
