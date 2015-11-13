<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTagMapper extends Model {

    protected $table = 'article_tag_mappers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'tag_id'
    ];
}
