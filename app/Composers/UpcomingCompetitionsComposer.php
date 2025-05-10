<?php

namespace App\Composers;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class UpcomingCompetitionsComposer
{
    public function compose(View $view): void
    {
        $view->with('competitions', self::loadUpcomingCompetitions());
    }

    public static function loadUpcomingCompetitions(): Collection
    {
        $current = Competition::whereDate("start_date", "<", now())
            ->orderBy("start_date", "desc")->limit(1);
        $upcoming = Competition::whereDate("end_date", ">=", now())
            ->orderBy("start_date", "asc")->limit(5);

        return $current->union($upcoming)->orderBy("start_date", "asc")->limit(5)->get();
    }
}
