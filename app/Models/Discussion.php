<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

    protected $table = 'discussions';

    protected $fillable = [
        'user_id',
        'article_id',
        'text',
        'parent'
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
