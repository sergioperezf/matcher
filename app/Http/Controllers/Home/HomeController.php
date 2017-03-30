<?php

namespace App\Http\Controllers\Home;

use App\Algorithms\KMeansExtended;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Contact;
use App\Services\Geolocator;
use App\Services\Matcher;

/**
 * Class HomeController
 * @package App\Http\Controllers\Home
 */
class HomeController extends Controller
{
    public function __invoke()
    {
        return view('welcome');
    }
}