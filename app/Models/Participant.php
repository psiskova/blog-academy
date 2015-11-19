<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model {

    /**
     * User does not sent invitation
     */
    const NOTHING = 0;
    /**
     * User sent invitation into course
     */
    const JOINED = 1;
    /**
     * User is accepted in course
     */
    const ACCEPTED = 2;
    /**
     * User is rejected from course
     */
    const REJECTED = 3;

    protected $table = 'participants';

    protected $fillable = [
        'user_id',
        'course_id',
        'state'
    ];

    public function user() {

        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function course() {

        return $this->belongsTo(Course::class);
    }
}
