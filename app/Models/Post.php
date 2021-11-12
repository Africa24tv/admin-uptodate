<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'resume',
        'is_send',
        'is_video',
        'author_id',
        'status',
        'subject_id',
        'validator_id',
        'private',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }

    public function article()
    {
        return $this->hasOne(Article::class, 'id', 'id');
    }

    static public function articles()
    {
        return Post::join('articles', 'articles.id', 'posts.id')
                    ->get();
    }

    public function event()
    {
        return $this->hasOne(Event::class, 'id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
