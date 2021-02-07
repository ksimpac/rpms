<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'username';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'chineseName', 'username', 'password',  'email', 'National_ID_No', 'is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function general_info()
    {
        return $this->hasOne('App\General_info', 'username');
    }

    public function educations()
    {
        return $this->hasMany('App\Education', 'username');
    }

    public function industry_experiences()
    {
        return $this->hasMany('App\Industry_experience', 'username');
    }

    public function most_projects()
    {
        return $this->hasMany('App\Most_project', 'username');
    }

    public function others()
    {
        return $this->hasMany('App\Other', 'username');
    }

    public function tcases()
    {
        return $this->hasMany('App\Tcase', 'username');
    }

    public function thesis_confs()
    {
        return $this->hasMany('App\Thesis_conf', 'username');
    }

    public function thesis()
    {
        return $this->hasMany('App\Thesis', 'username');
    }
}
