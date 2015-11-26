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
        'state',
        'task_id'
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

    public function task() {

        return $this->hasOne(Task::class, 'id', 'task_id');
    }

    public function tags() {

        $articleMapper = array_flatten(ArticleTagMapper::where('article_id', '=', $this->id)->get(['tag_id'])->toArray());
        $tags = Tag::whereIn('id', $articleMapper);

        return $tags;
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

    public function getAverageRatingAttribute() {
        $rating = Rating::where('article_id', '=', $this->id)->where('text', '=', '')->avg('rating');

        return $rating;
    }

    /**
     * Return only published articles
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query) {

        return $query->where('state', '=', Article::PUBLISHED);
    }

    /**
     * Return only drafts
     *
     * @param $query
     * @return mixed
     */
    public function scopeDraft($query) {

        return $query->where('state', '=', Article::DRAFT);
    }

    public function scopeUnrated($query, $course_id = null) {
        // TODO: article is not in rating or article is in rating and text <> ''
        /*$ratings = Rating::where('text', '<>', '');
        if ($course_id) {
            $course = Course::findBySlugOrId($course_id);
            $tasks = $course->tasks();
            $tasksIds = $tasks->get(['id'])->toArray(['id']);

            $articlesIds = array_flatten(Article::whereIn('task_id', array_flatten($tasksIds))->get(['id'])->toArray());
        }
        $ratings = $ratings->get(['article_id'])->toArray();*/


        return $query;//->whereNotIn('id', array_flatten($ratings));
    }

}
