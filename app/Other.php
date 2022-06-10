<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'other';
    protected $fillable = ['username', 'identification'];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
