<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'author',
      'message',
      'article_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'article_id');
    }
}
