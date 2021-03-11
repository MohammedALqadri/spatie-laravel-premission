<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    protected $appends = ['visible_comments_count'];

    public function getVisibleCommentsCountAttribute()
    {
        return $this->comments()->where('status', 'Visible')->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'blog_id','id');
    }


}
