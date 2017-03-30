<?php
/**
 * KMeansExtended.php
 */

namespace App\Algorithms;

use App\Exceptions\InvalidArgumentException;
use App\Models\Agent;
use KMeans\Space;

/**
 * Class KMeansExtended
 *
 * This class adds the ability to specify an array of centers of clusters.
 *
 * @package App\Algorithms
 */
class KMeansExtended extends Space {

    /**
     * @var boolean whether the centers of the clusters were manually given.
     */
    protected $clustersGiven = false;

    /**
     * @var boolean
     */
    protected $converge = true;

    /**
     * @param integer|array $nbClusters
     * @param integer $seed
     * @throws InvalidArgumentException
     * @return array
     */
    protected function initializeClusters($nbClusters, $seed) {
        if ($this->clustersGiven) {
            $clusters = [];
            foreach ($nbClusters as $agent) {
                if ($agent instanceof Agent && is_array($agent->getCoordinates())) {
                    $cluster = new Cluster($this, $agent->getCoordinates(), $agent);
                } else {
                    throw new InvalidArgumentException('Invalid Agent.');
                }
                $clusters[] = $cluster;
            }
            $clusters[0]->attachAll($this);
            return $clusters;
        } else {
            return parent::initializeClusters($nbClusters, $seed);
        }
    }

    /**
     * @param integer|array $nbClusters
     * @param int $seed
     * @param callable $iterationCallback
     * @param boolean $converge
     * @return array|mixed
     */
    public function solve($nbClusters, $seed = self::SEED_DEFAULT, $iterationCallback = null, $converge = true)
    {
        $this->converge = $converge;
        $this->clustersGiven = is_array($nbClusters);
        return parent::solve($nbClusters, $seed, $iterationCallback);
    }

    /**
     * @param \KMeans\Cluster[] $clusters
     * @return bool
     */
    protected function iterate($clusters) {
        $continue = parent::iterate($clusters);
        /*
         * Flags the termination of the iterations if the clusters were given. We
         * want that if the clusters are given, convergence not be sought after.
         */
        if (!$this->converge) {
            return false;
        }
        return $continue;
    }
}