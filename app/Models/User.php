<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    SluggableInterface {

    use Authenticatable,
        Authorizable,
        CanResetPassword,
        SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password'
    ];

    /**
     * The rules for model
     *
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'surname' => 'required',
        'password' => 'required',
        'email' => 'required|email|unique:users,email'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes from which are slug created
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'fullname',
        'save_to' => 'slug',
    ];

    /**
     * Get users full name
     * @return string
     */
    public function getFullnameAttribute() {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Declare IoC for articles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articles() {
        return $this->belongsToMany(Article::class);
    }
}
