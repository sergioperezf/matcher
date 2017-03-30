<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 28/03/17
 * Time: 10:56 PM
 */

namespace App\Services;


use App\Exceptions\ZipNotFoundException;
use App\Exceptions\ZipNotValidException;
use Illuminate\Support\Facades\Cache;
use Uvinum\ZipCode\Validator;

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

    /**
     * @var \Uvinum\ZipCode\Validator
     */
    protected $zipValidator;

    public function __construct(Geolocator $primaryLocator, Geolocator $secondaryLocator, Validator $zipValidator)
    {
        $this->primaryLocator = $primaryLocator;
        $this->secondaryLocator = $secondaryLocator;
        $this->zipValidator = $zipValidator;
    }

    function getCoordinatesByZipCode($zip)
    {
        if ($this->zipValidator->validate('US', $zip)){
            return Cache::remember('zip_' . $zip, 100000, function() use ($zip) {
                try {
                    $coordinates = $this->primaryLocator->getCoordinatesByZipCode($zip);
                } catch (ZipNotFoundException $e) {
                    $coordinates = $this->secondaryLocator->getCoordinatesByZipCode($zip);
                }
                return $coordinates;
            });
        } else {
            throw new ZipNotValidException('Zip ' . $zip . ' is not valid.');
        }
    }
}