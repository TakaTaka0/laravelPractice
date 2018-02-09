<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use Notifiable;
 /**
  * The event map for the model.
  *
  * @var array
  */
 protected $events = [
   'created' => ItemCreated::class
 ];  
}
