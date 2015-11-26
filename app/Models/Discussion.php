<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

    protected $table = 'discussions';

    protected $fillable = [
        'user_id',
        'article_id',
        'text',
        'parent'
    ];

    public function user() {

        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function article() {

        return $this->belongsTo(Article::class, 'id');
    }
}
