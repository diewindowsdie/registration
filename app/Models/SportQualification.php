<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification query()
 * @mixin \Eloquent
 */
class SportQualification extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
