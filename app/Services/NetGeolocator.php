<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 28/03/17
 * Time: 09:43 PM
 */

namespace App\Services;


use dotzero\GMapsGeocode;

class NetGeolocator implements Geolocator
{

    /**
     * @var GMapsGeocode
     */
    protected $geoCode;

    public function __construct(GMapsGeocode $geoCode)
    {
        $this->geoCode = $geoCode;
    }

    function getCoordinatesByZipCode($zip)
    {
        $location = $this->geoCode->setAddress($zip)
            ->setComponents([
                'country' => 'United States'
            ])
            ->search();
        return [$location[0]['geometry']['location']['lat'], $location[0]['geometry']['location']['lng']];
    }
}