<?php

namespace App\Services;

use App\Exceptions\ZipNotFoundException;

/**
 * Class LocalGeolocator
 * @package App\Services
 */
class LocalGeolocator implements Geolocator
{

    /**
     * @var array
     */
    private $coordinates;

    public function __construct()
    {
        $fileName = base_path('resources/data/codes.csv');
        $file = fopen($fileName, "r");
        $coordinates = [];
        while (($data = fgetcsv($file, 0, ",")) !== false) {
            $zip = $data[0];
            $lat = $data[1];
            $lng = $data[2];

            $coordinates[$zip] = [$lat, $lng];
        }
        $this->coordinates = $coordinates;
        fclose($file);
    }

    /**
     * @inheritdoc
     */
    function getCoordinatesByZipCode($zip)
    {
        if (!isset($this->coordinates[$zip])) {
            throw new ZipNotFoundException('Zip code ' . $zip . ' not found locally.');
        }
        return $this->coordinates[$zip];
    }
}