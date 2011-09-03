<?php

namespace RedditApiClient;

use \ArrayAccess;

/**
 * RedditEntity 
 *
 * Base-class for modeling entities exposed by the API
 *
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @uses      \ArrayAccess
 * @version   0.00
 */
abstract class RedditEntity implements ArrayAccess {

	/**
	 * An associative array of the raw API data that represents the entity
	 * 
	 * @access private
	 * @var    array
	 */
	private $data = array();

	/**
	 * ArrayAccess: Indicates whether the given value exists
	 * 
	 * @access public
	 * @param  string $name 
	 * @return boolean
	 */
	public function offsetExists($name)
	{
		return isset($this->data[$name]);
	}

	/**
	 * ArrayAccess: Returns the value of the given name
	 * 
	 * @access public
	 * @param  string $name 
	 * @return string
	 */
	public function offsetGet($name)
	{
		return $this->data[$name];
	}

	/**
	 * ArrayAccess: Stores the given name-value pair
	 * 
	 * @access public
	 * @param  string $name 
	 * @param  mixed $value 
	 */
	public function offsetSet($name, $value)
	{
		$this->data[$name] = $value;
	}

	/**
	 * ArrayAccess: Removes the value of the given name
	 * 
	 * @access public
	 * @param  string $name 
	 */
	public function offsetUnset($name)
	{
		unset($this->data[$name]);
	}

}

