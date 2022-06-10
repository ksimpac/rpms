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
    protected $fillable = [
        'username', 'publicationName', 'publicationDate', 'DOI', 'authorNo',
        'order', 'rank_factor', 'corresponding_author', 'thesisName',
        'type', 'identification'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
