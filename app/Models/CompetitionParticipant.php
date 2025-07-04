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
 * @property string $division_code
 * @property string $class_code
 * @property string|null $sport_school_code
 * @property string|null $sport_organisation_code
 * @property string $contact_information
 * @property string|null $coach_name
 * @property int $participate_teams
 * @property int $participate_mixed_teams
 * @property string|null $sport_school_or_club
 * @property string $region_code
 * @property-read \App\Models\ArcheryClass|null $archeryClass
 * @property-read \App\Models\Athlete|null $athlete
 * @property-read \App\Models\Competition|null $competition
 * @property-read \App\Models\Division|null $division
 * @property-read \App\Models\AthleteRegion|null $region
 * @property-read \App\Models\SportOrganisation|null $sportOrganisation
 * @property-read \App\Models\SportSchool|null $sportSchool
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereAthleteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereClassCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCoachName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereContactInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereDivisionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereParticipateMixedTeams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereParticipateTeams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereSportOrganisationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereSportSchoolCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereSportSchoolOrClub($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CompetitionParticipant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompetitionParticipant extends Model
{
    protected $with = ["athlete", "competition", "division", "archeryClass", "sportSchool", "sportOrganisation", "region"];

    public function athlete(): HasOne
    {
        return $this->hasOne(Athlete::class, "id", "athlete_id");
    }

    public function competition(): HasOne
    {
        return $this->hasOne(Competition::class, "id", "competition_id");
    }

    public function division(): HasOne
    {
        return $this->hasOne(Division::class, "code", "division_code");
    }

    public function archeryClass(): HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class_code");
    }

    public function sportSchool(): HasOne
    {
        return $this->hasOne(SportSchool::class, "code", "sport_school_code");
    }

    public function sportOrganisation(): HasOne
    {
        return $this->hasOne(SportOrganisation::class, "code", "sport_organisation_code");
    }

    public function region(): HasOne
    {
        return $this->hasOne(AthleteRegion::class, "code", "region_code");
    }
}
