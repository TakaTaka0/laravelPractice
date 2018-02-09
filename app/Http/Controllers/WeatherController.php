<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    //
  public function weatherCall () {
      //$posts = Post::latest()->get();
      $url = "http://api.openweathermap.org/data/2.5/weather?q=Tokyo,jp&units=metric&appid=b813487fc3b513a73268b3e7e6cdc1f1";
      $json = file_get_contents($url);
      $test = json_decode($json)
      return view('weather.weatherCall')->with('test',$test);

    }
}
