<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Course extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $table = 'courses';

    protected $fillable = [
        'user_id',
        'name',
        'year'
    ];

    /**
     * Get course teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function teacher() {

        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get all participants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function participants() {

        return $this->hasMany(Participant::class, 'course_id', 'id');
    }

}