<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportOrganisation extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
