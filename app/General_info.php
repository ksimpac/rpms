<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General_info extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'general_info';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
