<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Home extends Model
{
    public function getPublishedNews()
    {
        $homeNews = Home::all();
        return $homeNews;
    }
}
