<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry_experience extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'industry_experience';

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
