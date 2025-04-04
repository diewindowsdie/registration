<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitionGroup extends Model
{
    protected $with = ["division", "archeryClass"];

    public function division(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Division::class, "code", "division");
    }

    public function archeryClass(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ArcheryClass::class, "code", "class");
    }
}
