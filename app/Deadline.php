<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $table = 'deadline';
    protected $fillable = ['time', 'roc_format'];
}
