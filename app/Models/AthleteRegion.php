<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AthleteRegion extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
