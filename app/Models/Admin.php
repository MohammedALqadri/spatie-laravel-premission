<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasRoles;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    use HasFactory;
    public function blogs(){

        return $this->hasMany(Blog::class, 'admin_id', 'id');

    }
    protected $appends = ['visible_blogs_count'];

    public function getVisibleBlogsCountAttribute()
    {
        return $this->blogs()->where('status', 'Visible')->count();
    }

}
