<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name'];
    protected $appends = ['visible_blogs_count'];

    public function getVisibleBlogsCountAttribute()
    {
        return $this->blogs()->where('status', 'Active')->count();
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class,'category_id','id');
    }
}
