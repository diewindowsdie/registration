<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property string $code
 * @property array<array-key, mixed> $allowed_genders
 * @property int $min_age
 * @property int|null $max_age
 * @property int $order
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereAllowedGenders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereMaxAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereMinAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ArcheryClass whereOrder($value)
 * @mixin \Eloquent
 */
class ArcheryClass extends Model
{
    protected $casts = [
        'allowed_genders' => "array"
    ];

    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';
}
