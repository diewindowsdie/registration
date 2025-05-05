<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $code
 * @property int $is_country
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteRegion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteRegion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteRegion query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteRegion whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AthleteRegion whereIsCountry($value)
 * @mixin \Eloquent
 */
class AthleteRegion extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
}
