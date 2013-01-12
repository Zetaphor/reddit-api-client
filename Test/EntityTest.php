<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Entity;

/**
 * EntityTest
 *
 * Tests the underling functionality that powers the base class for modeling
 * the entities exposed by the API
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class EntityTest extends PHPUnit_Framework_TestCase
{

    private $entity;

    public function setUp()
    {
        $this->entity = new Fake_Entity;
    }

    /**
     * Just checks the ArrayAccess implementation
     */
    public function testArrayAccess()
    {
        $this->entity = new Fake_Entity;
        $this->entity->setData(array('y' => 2));

        $this->assertTrue(isset($this->entity['y']));
        $this->assertFalse(isset($this->entity['x']));

        $this->entity['x'] = 1;
        $this->assertEquals(1, $this->entity['x']);
        $this->assertTrue(isset($this->entity['x']));

        unset($this->entity['x']);
        $this->assertFalse(isset($this->entity['x']));
    }

    /**
     * Ensures that Entity returns timestamps in the expected way
     */
    public function testGetCreated()
    {
        $this->assertEquals(null, $this->entity->getCreated());

        $this->entity->setData(array('created' => '1308174144.0'));

        $this->assertEquals(1308174144, $this->entity->getCreated());
    }

    /**
     * Ensures that Entity returns timestamps in the expected way
     */
    public function testGetCreatedUtc()
    {
        $this->assertEquals(null, $this->entity->getCreatedUtc());

        $this->entity->setData(array('created_utc' => '1308174144.0'));

        $this->assertEquals(1308174144, $this->entity->getCreatedUtc());
    }
}
