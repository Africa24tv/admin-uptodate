<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'level',
        'execution',
        'user_id',
        'body',
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function acteurs()
    {
        return $this->belongsToMany(User::class, 'tache_users');
    }
}
