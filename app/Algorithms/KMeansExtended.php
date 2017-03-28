<?php
/**
 * KMeansExtended.php
 */

namespace App\Algorithms;

use KMeans\Cluster;
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
     * @var bool whether the centers of the clusters were manually given.
     */
    protected $clustersGiven = false;

    /**
     * @param integer|array $nbClusters
     * @param integer $seed
     * @return array
     */
    protected function initializeClusters($nbClusters, $seed) {
        if ($this->clustersGiven) {
            $clusters = [];
            foreach ($nbClusters as $center) {
                $clusters[] = new Cluster($this, $center);
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
     * @return array|mixed
     */
    public function solve($nbClusters, $seed = self::SEED_DEFAULT, $iterationCallback = null)
    {
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
        if ($this->clustersGiven) {
            return false;
        }
        return $continue;
    }
}