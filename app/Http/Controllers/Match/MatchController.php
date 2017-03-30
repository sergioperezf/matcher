<?php
/**
 * MatchController.php
 */

namespace App\Http\Controllers\Match;


use App\Algorithms\KMeansExtended;
use App\Exceptions\ZipNotValidException;
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

    /**
     * @var array
     */
    protected $initialContacts;

    public function __construct(Geolocator $geolocator, Matcher $matcher, array $initialContacts) {
        $this->matcher = $matcher;
        $this->geolocator = $geolocator;
        $this->initialContacts = $initialContacts;
    }

    public function __invoke(Request $request) {
        $agents[] = new Agent('Agent A', $request->get('agent-a-zip'));
        $agents[] = new Agent('Agent B', $request->get('agent-b-zip'));
        try {
            foreach ($agents as $agent) {
                $agent->setCoordinates($this->geolocator->getCoordinatesByZipCode($agent->getZip()));
            }
        } catch (ZipNotValidException $e) {
            return view('welcome', ['error' => $e->getMessage()]);
        }

        $contacts = [];
        foreach ($this->initialContacts as $contact) {
            $contact = new Contact($contact[0], $contact[1]);
            $contact->setCoordinates($this->geolocator->getCoordinatesByZipCode($contact->getZip()));
            $contacts[] = $contact;
        }

        $matches = $this->matcher->matchContactsToAgents($contacts, $agents);

        return view('match', ['clusteredData' => $matches]);

    }
}