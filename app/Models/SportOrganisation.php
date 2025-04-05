<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $code
 * @property string $short_title
 * @property string $full_title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation whereFullTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportOrganisation whereShortTitle($value)
 * @mixin \Eloquent
 */
class SportOrganisation extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
