<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArcheryClass extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
