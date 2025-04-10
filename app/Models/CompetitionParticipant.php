<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 *
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $athlete_id
 * @property int $competition_id
 * @property \App\Models\Division|null $division
 * @property string $class
 * @property int|null $team_participation
 * @property int|null $mixed_team_participation
 * @property string|null $sport_school
 * @property string|null $sport_organisation
 * @property string $contact_information
 * @property string|null $coach_name
 * @property-read \App\Models\ArcheryClass|null $archeryClass
 * @property-read \App\Models\Athlete|null $athlete
 * @property-read \App\Models\Competition|null $competition
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereAthleteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCoachName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereContactInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereDivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereMixedTeamParticipation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereSportOrganisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereSportSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereTeamParticipation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompetitionParticipant extends Model
{
    protected $with = ["athlete", "competition", "division", "archeryClass"];

    public function athlete(): HasOne
    {
        return $this->hasOne(Athlete::class);
    }

    public function competition(): HasOne
    {
        return $this->hasOne(Competition::class);
    }

    public function division(): HasOne
    {
        return $this->hasOne(Division::class, "code", "division_code");
    }

    public function archeryClass(): HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class_code");
    }
}
