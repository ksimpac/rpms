<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis_conf extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'thesis_conf';
    protected $fillable = [
        'username', 'conf_name', 'thesisName', 'years', 'authorNo',
        'corresponding_author', 'country'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
