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
    protected $table = 'most_project';
    protected $fillable = [
        'username', 'projectName', 'startDate', 'endDate',
        'jobkind', 'plantotal_money', 'identification'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
