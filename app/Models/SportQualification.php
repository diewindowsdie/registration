<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $code
 * @property string $short_title
 * @property string $full_title
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification whereFullTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SportQualification whereShortTitle($value)
 * @mixin \Eloquent
 */
class SportQualification extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
