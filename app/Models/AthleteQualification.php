<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteQualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteQualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteQualification query()
 * @mixin \Eloquent
 */
class AthleteQualification extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
