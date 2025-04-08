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
 * @property string $surname
 * @property string $first_name
 * @property string|null $patronymic
 * @property string $gender
 * @property \Illuminate\Support\Carbon $birth_date
 * @property string $qualification
 * @property int $using_chair
 * @property string $region_code
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete wherePatronymic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Athlete whereUsingChair($value)
 * @mixin \Eloquent
 */
class Athlete extends Model
{
    protected $casts = [
        'birth_date' => 'date',
    ];

    protected $with = ["region", "qualification"];

    public function region(): HasOne
    {
        return $this->hasOne(AthleteRegion::class, "code", "region_code");
    }

    public function qualification(): HasOne
    {
        return $this->hasOne(SportQualification::class, "code", "qualification");
    }
}
