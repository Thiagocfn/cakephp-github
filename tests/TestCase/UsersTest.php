<?php

namespace CvoTechnologies\GitHub\Test\TestCase;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\ModelAwareTrait;
use Cake\TestSuite\TestCase;
use Muffin\Webservice\Model\Endpoint;

/**
 * @property  Endpoint Users
 */
class UsersTest extends TestCase
{

    use ModelAwareTrait;

    public function setUp()
    {
        parent::setUp();
        $configs = ConnectionManager::configured();
        if (!in_array('git_hub',$configs,true)) {
            ConnectionManager::config('git_hub', [
                'className' => 'Muffin\Webservice\Connection',
                'service' => 'CvoTechnologies/GitHub.GitHub',
            ]);
        }
        $this->modelFactory('Endpoint', ['Muffin\Webservice\Model\EndpointRegistry', 'get']);

        $this->loadModel('CvoTechnologies/GitHub.Users', 'Endpoint');
    }


    public function testUsers()
    {
        $issues = $this->Users->find()->where([
            'user' => 'thiagocfn'
        ]);
        $users = $issues->all();
        static::assertEquals("Thiagocfn", $users->first()->login);
    }

    public function testUsersNotFound()
    {
        $issues = $this->Users->find()->where([
            'user' => 'thiaagocfn'
        ]);
        $users = $issues->all();
        static::assertFalse($users);
    }

}
