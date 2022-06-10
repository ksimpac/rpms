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
    protected $fillable = [
        'username', 'working_units', 'position', 'type',
        'job_description', 'startDate', 'endDate', 'identification'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
