<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillabe = ['name'];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
}
