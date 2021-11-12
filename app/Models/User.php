<?php

namespace App\Models;

use App\Http\Resources\ArticleResource;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Tymon\JWTAuth\Contracts\JWTSubject;

// class User extends Authenticatable implements JWTSubject
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function articles()
    {
        // $articles = collect(new Article());
        $articles = [];
        $posts  = $this->posts;
        // dd($posts);
        foreach($posts as $post)
        {
            if($post->article)
            {
                // array_push($articles, new ArticleResource($post->article));
                array_push($articles, $post->article);
                // $articles->push($post->article);
            }
        }

        return $articles;
    }

    public function actu()
    {
        return $this->hasMany(Actu::class);
    }

    public function taches()
    {
        return $this->belongsToMany(Tache::class, 'tache_users');
    }

    public function preferences()
    {
        return $this->belongsToMany(Category::class, 'preferences');
    }

    public function readingList()
    {
        return $this->belongsToMany(Article::class, 'reading_list');
    }

    public function agenda()
    {
        return $this->belongsToMany(Event::class, 'agendas');
    }

    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }

    public function productivites()
    {
        $nbres_taches = $this->taches()->count();

        $nbre_realiser = $this->taches()->whereExecution('terminée')->count();

        // dd($nbre_realiser);

        if($nbres_taches == 0)
            return 0;

        return ($nbre_realiser / $nbres_taches)*100;
    }

    static public function prod()
    {
        $users = User::all();

        $prod_total = 0;
        foreach($users as $user)
        {
            $prod_total += $user->productivites();
        }

        $nbre_users = User::count();

        return $prod_total / $nbre_users;
    }
}
