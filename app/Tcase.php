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
    protected $fillable = [
        'username', 'projectName', 'collaboration_name', 'startDate',
        'endDate', 'jobkind', 'plantotal_money', 'identification'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
