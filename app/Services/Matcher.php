<?php

namespace App\Services;



interface Matcher
{
    /**
     * Matches a list of contacts to a list of agents.
     *
     * @param \App\Models\Contact[] $contacts
     * @param \App\Models\Agent[] $agents
     */
    function matchContactsToAgents($contacts, $agents);
}