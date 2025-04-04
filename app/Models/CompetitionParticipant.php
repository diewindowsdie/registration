<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionParticipant extends Model
{
    protected $with = ["athlete", "competition", "division", "archeryClass"];

    public function athlete(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Athlete::class);
    }

    public function competition(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Competition::class);
    }

    public function division(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Division::class, "code", "division");
    }

    public function archeryClass(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class");
    }
}
