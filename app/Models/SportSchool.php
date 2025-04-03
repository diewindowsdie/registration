<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportSchool extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
