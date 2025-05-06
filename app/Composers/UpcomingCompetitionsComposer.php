<?php

namespace App\Composers;

use App\Models\Competition;
use Illuminate\View\View;

class UpcomingCompetitionsComposer
{
    public function compose(View $view): void
    {
        $view->with('competitions', Competition::whereDate("end_date", ">=", now())->orderBy("start_date", "asc")->limit(5)->get());
    }
}
