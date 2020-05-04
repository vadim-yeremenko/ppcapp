<?php

namespace App\Library\Filters;

use App\Library\StatsList;

class StatsListFilter
{
    public function __construct()
    {

    }

    public function get_request_data($request)
    {
        $stats = new StatsList();

        return $stats->get_stats_for_filter($request);
    }
}