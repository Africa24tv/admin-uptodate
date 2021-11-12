<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'resume',
        'type_id',
        'subject_id',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function videos()
    {
        return $this->hasMany(Post::class);
    }

    public function _parent()
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }
}
