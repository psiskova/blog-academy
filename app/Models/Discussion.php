<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model {

    use SoftDeletes;

    protected $table = 'discussions';

    protected $fillable = [
        'user_id',
        'article_id',
        'text',
        'parent'
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

    public function user() {

        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function article() {

        return $this->belongsTo(Article::class, 'id');
    }
}
