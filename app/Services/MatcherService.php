<?php

namespace App\Services;

use App\Algorithms\KMeansExtended;

/**
 * Class MatcherService
 * @package App\Services
 */
class MatcherService implements Matcher
{

    /**
     * @var \App\Algorithms\KMeansExtended
     */
    protected $kMeans;

    function __construct(KMeansExtended $kMeans)
    {
        $this->kMeans = $kMeans;
    }

    /**
     * @inheritdoc
     */
    function matchContactsToAgents($contacts, $agents)
    {
        foreach ($contacts as $contact) {
            $this->kMeans->attach($this->kMeans->newPoint($contact->getCoordinates()), $contact);
        }

        $clusters = $this->kMeans->solve($agents, null, null, false);

        return $clusters;
    }
}