<?php

namespace App\Algorithms;

use App\Models\Agent;
use KMeans\Space;

/**
 * Class Cluster
 * @package App\Algorithms
 */
class Cluster extends \KMeans\Cluster
{
    /**
     * @var \App\Models\Agent
     */
    protected $agent;

    /**
     * @return \App\Models\Agent
     */
    public function getAgent() {
        return $this->agent;
    }

    public function __construct(Space $space, array $coordinates, Agent $agent) {
        $this->agent = $agent;
        parent::__construct($space, $coordinates);
    }
}