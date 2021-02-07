<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'education';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
