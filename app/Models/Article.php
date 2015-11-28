<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model implements SluggableInterface {

    use SluggableTrait, SoftDeletes;

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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
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

    public function discussions() {

        return $this->hasMany(Discussion::class, 'article_id', 'id');
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
        $rating = Rating::where('article_id', '=', $this->id)->avg('rating');
        if (!$rating) {
            $rating = 0;
        }

        return $rating;
    }

    public function getTeacherRatingValueAttribute() {
        $rating = Rating::where('article_id', '=', $this->id)->where('text', '<>', '')->first(['rating']);

        return $rating->rating;
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
        $course = Course::findBySlugOrId($course_id);
        $tasks = $course->tasks();
        $tasksIds = $tasks->get(['id'])->toArray(['id']);

        $articlesTaskIds = array_flatten(Article::whereIn('task_id', array_flatten($tasksIds))->get(['id'])->toArray());

        $articlesWithoutAnyRating = Article::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('ratings')
                ->whereRaw('articles.id = ratings.article_id');
        })->whereIn('articles.id', $articlesTaskIds)->get(['articles.id'])->toArray();

        $articlesWithSomeRating = Article::whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('ratings')
                ->whereRaw('articles.id = ratings.article_id')
                ->where('ratings.text', '=', '');
        })->whereIn('articles.id', $articlesTaskIds)->get(['articles.id'])->toArray();

        $articles = array_collapse([array_flatten($articlesWithoutAnyRating), array_flatten($articlesWithSomeRating)]);

        return $query->whereIn('id', $articles);
    }

    public function scopeRated($query, $course_id) {
        $course = Course::findBySlugOrId($course_id);
        $tasks = $course->tasks();
        $tasksIds = $tasks->get(['id'])->toArray(['id']);

        $articlesTaskIds = array_flatten(Article::whereIn('task_id', array_flatten($tasksIds))->get(['id'])->toArray());

        $articlesWithSomeRating = Article::whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('ratings')
                ->whereRaw('articles.id = ratings.article_id')
                ->where('ratings.text', '<>', '');
        })->whereIn('articles.id', $articlesTaskIds)->get(['articles.id'])->toArray();

        return $query->whereIn('id', array_flatten($articlesWithSomeRating));
    }

}
