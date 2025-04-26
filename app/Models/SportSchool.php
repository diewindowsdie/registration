<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $code
 * @property string $short_title
 * @property string $full_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool whereFullTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportSchool whereShortTitle($value)
 * @mixin \Eloquent
 */
class SportSchool extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
