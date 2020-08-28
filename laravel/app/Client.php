<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';

    protected $fillable = [
        'company', 'name', 'lastname', 'email', '', 'telephone', 'street', 'zipcode', 'city'
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function projects()
    {
        return $this->belongsTo(Projects::class);
    }
}
