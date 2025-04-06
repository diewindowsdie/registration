<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $title
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $created_by
 * @property \Illuminate\Support\Carbon $registration_start
 * @property \Illuminate\Support\Carbon $registration_finish
 * @property int $competition_includes_teams
 * @property int $competition_includes_mixed_teams
 * @property int $participants_list_available_to_anyone
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CompetitionGroup> $groups
 * @property-read int|null $groups_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereCompetitionIncludesMixedTeams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereCompetitionIncludesTeams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereParticipantsListAvailableToAnyone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereRegistrationFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereRegistrationStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Competition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Competition extends Model
{
    protected $with = ["groups"];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_start' => 'datetime',
        'registration_finish' => 'datetime',
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(CompetitionGroup::class);
    }
    //
}
