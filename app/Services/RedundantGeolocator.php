<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 28/03/17
 * Time: 10:56 PM
 */

namespace App\Services;


use Illuminate\Support\Facades\Cache;

class RedundantGeolocator implements Geolocator
{
    /**
     * @var Geolocator
     */
    protected $primaryLocator;

    /**
     * @var Geolocator
     */
    protected $secondaryLocator;

    public function __construct(Geolocator $primaryLocator, Geolocator $secondaryLocator)
    {
        $this->primaryLocator = $primaryLocator;
        $this->secondaryLocator = $secondaryLocator;
    }

    function getCoordinatesByZipCode($zip)
    {
        return Cache::remember('zip_' . $zip, 100000, function() use ($zip) {
            try {
                $coordinates = $this->primaryLocator->getCoordinatesByZipCode($zip);
            } catch (\Exception $e) {
                $coordinates = $this->secondaryLocator->getCoordinatesByZipCode($zip);
            }
            return $coordinates;
        });

    }
}