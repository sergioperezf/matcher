<?php

namespace App\Models;

/**
 * Class Contact
 * @package App\Models
 */
class Contact
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer[]
     */
    private $coordinates;

    /**
     * @var string
     */
    private $zip;

    /**
     * Contact constructor.
     * @param string $name
     * @param string $zip
     */
    public function __construct($name, $zip)
    {
        $this->name = $name;
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return \integer[]
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param \integer[] $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }
}