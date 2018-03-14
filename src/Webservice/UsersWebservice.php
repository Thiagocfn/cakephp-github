<?php

namespace CvoTechnologies\GitHub\Webservice;

use Muffin\Webservice\Model\Endpoint;
use Muffin\Webservice\Query;
use Muffin\Webservice\ResultSet;

class UsersWebservice extends GitHubWebservice
{

    /**
     * {@inheritDoc}
     */
    public function initialize()
    {
        parent::initialize();

        $this->addNestedResource('/users/:user', [
            'user'
        ]);
    }

    /**
     * @param Query $query
     * @param array $options
     * @return ResultSet
     */
    /**
     * @param Endpoint $endpoint
     * @param array $results
     * @return array
     */
    protected function _transformResults(Endpoint $endpoint, array $results)
    {
        $resources = [];
        // for this webservice, or come empty result or a single result. Never a list
        $resources[] = $this->_transformResource($endpoint, $results);

        return $resources;
    }
}
