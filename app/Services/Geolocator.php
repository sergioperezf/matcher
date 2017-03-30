<?php

namespace App\Services;

/**
 * Interface GeolocatorInterface
 * @package App\Services
 */
interface Geolocator
{
    /**
     * Returns the latitude and longitude of the centroid of the given zip code.
     *
     * @param string $zip
     * @return array
     */
    function getCoordinatesByZipCode($zip);
}