<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 *
 * @property int $id
 * @property int $competition_id
 * @property string $division_code
 * @property string $class_code
 * @property array<array-key, mixed> $allowed_genders
 * @property \Illuminate\Support\Carbon|null $min_birth_date
 * @property \Illuminate\Support\Carbon $max_birth_date
 * @property int $includes_teams
 * @property-read \App\Models\ArcheryClass|null $archeryClass
 * @property-read \App\Models\Division|null $division
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereAllowedGenders($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereDivisionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereIncludesTeams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereMaxBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionGroup whereMinBirthDate($value)
 * @mixin \Eloquent
 */
class CompetitionGroup extends Model
{
    public $timestamps = false;
    protected $with = ["division", "archeryClass", "minQualification"];

    protected $casts = [
        'min_birth_date' => 'date',
        'max_birth_date' => 'date',
        'allowed_genders' => "array"
    ];

    public function division(): HasOne
    {
        return $this->hasOne(Division::class, "code", "division_code");
    }

    public function archeryClass(): HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class_code");
    }

    public function minQualification(): HasOne
    {
        return $this->hasOne(SportQualification::class, "code", "min_qualification_code");
    }
}
