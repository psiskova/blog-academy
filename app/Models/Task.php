<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Task extends Model implements SluggableInterface {

    use SluggableTrait;


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'course_id'
    ];

    /**
     * The attributes from which are slug created
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];
}
