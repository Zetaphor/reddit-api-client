<?php

namespace RedditApiClient\Test;

require_once '../Entity.php';
require_once 'Fake/Entity.php';
require_once 'PHPUnit/Framework/TestCase.php';

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
 * @version    0.00
 */
class EntityTest extends PHPUnit_Framework_TestCase {

	/**
	 * Just checks the ArrayAccess implementation 
	 */
	public function testArrayAccess()
	{
		$entity = new Fake_Entity;
		$entity->setData(array('y' => 2));

		$this->assertTrue(isset($entity['y']));
		$this->assertFalse(isset($entity['x']));

		$entity['x'] = 1;
		$this->assertEquals(1, $entity['x']);
		$this->assertTrue(isset($entity['x']));

		unset($entity['x']);
		$this->assertFalse(isset($entity['x']));
	}
	

}

