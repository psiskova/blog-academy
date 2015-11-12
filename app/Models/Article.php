<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements SluggableInterface {

    use SluggableTrait;

    const DRAFT = 0;
    const PUBLISHED = 1;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'user_id',
        'text',
        'state'
    ];

    /**
     * The attributes from which are slug created
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'title',
        'save_to' => 'slug',
    ];

    protected $rules = [
        'title' => 'required',
        'text' => 'required'
    ];

    /**
     * Get author of article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tags() {

        return $this->hasManyThrough('App\Models\Tag', 'App\Models\ArticleTagMapper', 'article_id', 'id', 'id');
    }

    /**
     * Get created_at attribute in d.m.Y format
     *
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
    }

    /**
     * Get updated_at attribute in d.m.Y format
     *
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
    }

    public function scopePublished($query) {
        return $query->where('state', '=', Article::PUBLISHED);
    }

    public function scopeDraft($query) {
        return $query->where('state', '=', Article::DRAFT);
    }
}
