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
    protected $fillable = [
        'username', 'englishLastName', 'englishFirstName', 'birthday', 'sex',
        'telephone', 'Permanent_Address', 'Residential_Address',
        'teacherCertificateType', 'teacherCertificateFiles',
        'working_units', 'position', 'startDate', 'specialization',
        'course'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'username');
    }
}
