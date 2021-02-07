<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'thesis';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
