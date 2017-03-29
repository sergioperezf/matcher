<?php
/**
 * MatchController.php
 */

namespace App\Http\Controllers\Match;


use App\Algorithms\KMeansExtended;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Contact;
use App\Services\Geolocator;
use App\Services\Matcher;
use Illuminate\Http\Request;

class MatchController extends Controller {
    /**
     * @var Geolocator
     */
    protected $geolocator;

    /**
     * @var KMeansExtended
     */
    protected $matcher;

    public function __construct(Geolocator $geolocator, Matcher $matcher) {
        $this->matcher = $matcher;
        $this->geolocator = $geolocator;
    }

    public function __invoke(Request $request) {
        $rawData = [
            ['Michael', 85273],
            ['James', 85750],
            ['Brian', 85751],
            ['Nicholas', 85383],
            ['Jennifer', 85716],
            ['Christopher', 85014],
            ['Michael', 85751],
            ['Patricia', 95032],
            ['Beth', 94556],
            ['Cathy', 92260],
            ['Harold', 92120],
            ['Robin', 94062],
            ['James', 90503],
            ['Douglas', 32159],
            ['Donald', 32404],
            ['Ilene', 33140],
            ['William', 33417],
            ['Lynn', 32789],
            ['Leonie', 33417],
            ['Katherine', 32034],
            ['Melissa', 30516],
            ['Kimberly', 30345],
            ['Richard', 30606],
            ['Richard', 30312],
            ['Ayn', 31901],
            ['Bruce', 31410],
            ['Fred', 89451],
            ['Robert', 89110],
            ['David', 89042],
            ['Maureen', 89074],
            ['Mary Sue', 89705],
            ['Janet', 89144],
            ['John', 89145],
            ['Rand', 12580],
            ['Kathy', 10604],
            ['Susan', 13601],
            ['Robin', 10021],
            ['Peter', 12550],
            ['Diana', 10603],
            ['Richard', 12018],
        ];
        $agents[] = new Agent('Agent A', $request->get('agent-a-zip'));
        $agents[] = new Agent('Agent B', $request->get('agent-b-zip'));
        foreach ($agents as $agent) {
            $agent->setCoordinates($this->geolocator->getCoordinatesByZipCode($agent->getZip()));
        }

        $contacts = [];
        foreach ($rawData as $contact) {
            $contact = new Contact($contact[0], $contact[1]);
            $contact->setCoordinates($this->geolocator->getCoordinatesByZipCode($contact->getZip()));
            $contacts[] = $contact;
        }

        $matches = $this->matcher->matchContactsToAgents($contacts, $agents);

        return view('match', ['clusteredData' => $matches]);

    }
}