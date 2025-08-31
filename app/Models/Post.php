<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model

{
    protected $fillable = ['title', 'text', 'img_url', 'video_url', 'caption'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = \Str::slug($post->title);
        });
    }
}