<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'link',
        'location',
        'organisateur',
    ];

    public function post()
    {
        try {
            return $this->belongsTo(Post::class, 'id', 'id');
        } catch (\Exception $e) {
            return new Post();
        }
    }
}
