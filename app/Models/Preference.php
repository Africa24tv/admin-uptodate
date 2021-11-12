<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * faire une fonction qui retourne les statistique des preferences pour voir les
     * preferences les plus consultés
     * */
}
