<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
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

    private function generateSlug($name)
    {
        $slug = Str::slug($name);
        if (static::whereSlug($slug)->exists()) {
            $max = static::whereName($name)->latest('id')->skip(1)->value('slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }

        return $slug;
    }
}
