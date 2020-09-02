<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Permissions\HasPermissionsTrait;


class User extends Authenticatable
{
    use Notifiable;
    use HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login', 'vat', 'wage'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'user_id', 'id');
    }

    public function project()
    {
        $this->belongsTo(Projects::class, 'user_id', 'id');
    }

	public function clients()
	{
		return $this->hasMany(Client::class);
	}

    public function todo()
    {
        return $this->hasMany(Todo::class);
    }

	public function sites()
	{
		return $this->hasMany(Sites::class);
	}
}
