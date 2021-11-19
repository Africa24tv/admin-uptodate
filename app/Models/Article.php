<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Post
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'body',
        'media_id',
        'type',
    ];

    public function post()
    {
        try{
            return $this->belongsTo(Post::class, 'id', 'id');
        }
        catch(\Exception $e)
        {
            return new Post();
        }
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    static public function userArticles(User $user)
    {
        $articles = Article::join('posts', 'articles.id', 'posts.id')
                            ->where('posts.author_id',$user->id);

        return $articles;
    }

    static public function articlesEnvoyer()
    {
        return Article::join('posts', 'articles.id', 'posts.id')
                ->whereStatus('envoyé');
    }
}
