<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'sites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'website', 'image', 'client_id', 'user_id'
    ];

    protected $hidden = [ ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

//    public function client()
//    {
//        return $this->belongsTo(Client::class, 'client_id', 'id');
//    }
}
