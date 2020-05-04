<?php
/*
 * Main Admin's feed controller
 *
 * */
namespace App\Library;

class FeedGet
{
    public function get_list()
    {
        $feed = \App\Feed::orderBy('id', 'asc')
            ->get();
        return $feed;
    }
}