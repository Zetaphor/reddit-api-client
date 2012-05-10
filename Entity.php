<?php

namespace RedditApiClient;

use \ArrayAccess;

/**
 * Entity 
 *
 * Base-class for modeling entities exposed by the API
 *
 * One of the main reasons why this class exists and why it provides
 * ArrayAccess the entity's data is that it's quite possible for the API to
 * change. For example, if they start sending some useful new field of data
 * for comments, and somebody out there is using this library and doesn't want
 * to wait for somebody to add a getter method for it, they can still get to it
 * in the short-term through ArrayAccess.
 *
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @uses      \ArrayAccess
 * @version   0.5.2
 */
abstract class Entity implements ArrayAccess {

	/**
	 * The Reddit client instance
	 * 
	 * @access protected
	 * @var    \RedditApiClient\Reddit
	 */
	protected $reddit;

	/**
	 * An associative array of the raw API data that represents the entity
	 * 
	 * @access private
	 * @var    array
	 */
	private $data = array();

	/**
	 * @access public
	 * @param  \RedditApiClient\Reddit $reddit 
	 */
	public function __construct($reddit = null) {
		$this->reddit = $reddit;
	}

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

	/**
	 * Stores the given array as the data to be used to represent the entity
	 * 
	 * @access public
	 * @param  array $data 
	 */
	public function setData(array $data)
	{
		$this->data = $data;
	}

	/**
	 * Returns the creation timestamp of the entity
	 *
	 * This getter method is included a little deeper in the class hierarchy
	 * because every entity returned by the Reddit API includes this data.
	 * 
	 * @access public
	 * @return integer
	 */
	public function getCreated()
	{
		return isset($this['created']) ? $this['created'] : null;
	}

	/**
	 * Returns the UTC creation timestamp of the entity
	 *
	 * This getter method is included a little deeper in the class hierarchy
	 * because every entity returned by the Reddit API includes this data.
	 * 
	 * @access public
	 * @return integer
	 */
	public function getCreatedUtc()
	{
		return isset($this['created_utc']) ? $this['created_utc'] : null;
	}

}

