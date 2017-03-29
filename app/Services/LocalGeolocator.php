<?php

namespace App\Services;

/**
 * Class LocalGeolocator
 * @package App\Services
 */
class LocalGeolocator implements Geolocator
{

    /**
     * @inheritdoc
     */
    function getCoordinatesByZipCode($zip)
    {
        return ['4', '0'];
    }
}