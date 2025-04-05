<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 
 *
 * @property int $id
 * @property int $competition_id
 * @property \App\Models\Division|null $division
 * @property string $class
 * @property string $allowed_genders
 * @property \Illuminate\Support\Carbon $min_birth_date
 * @property \Illuminate\Support\Carbon $max_birth_date
 * @property-read \App\Models\ArcheryClass|null $archeryClass
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereAllowedGenders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereDivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereMaxBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereMinBirthDate($value)
 * @mixin \Eloquent
 */
class CompetitionGroup extends Model
{
    protected $with = ["division", "archeryClass"];
    protected $casts = [
        'min_birth_date' => 'date:d.m.Y',
        'max_birth_date' => 'date:d.m.Y',
    ];

    public function division(): HasOne
    {
        return $this->hasOne(Division::class, "code", "division");
    }

    public function archeryClass(): HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class");
    }
}
