<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Most_project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'most_project';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
