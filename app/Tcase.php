<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tcase extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tcase';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
