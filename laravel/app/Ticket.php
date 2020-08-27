<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Ticket extends Model
{

   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
        'name', 'email', 'phone', 'catagory_id', 'ticket_id', 'title', 'priority', 'content', 'status'
    ];

    public function catagory()
    {
      return $this->belongsTo(Catagory::class);
    }
}
