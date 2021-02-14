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
    protected $table = 'MOST_project';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
