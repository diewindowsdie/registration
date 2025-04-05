<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property string $code
 * @property string $title
 * @property string $allowed_gender
 * @property int $min_age
 * @property int|null $max_age
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereAllowedGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereTitle($value)
 * @mixin \Eloquent
 */
class ArcheryClass extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
