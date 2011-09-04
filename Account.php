<?php

namespace RedditApiClient;

require_once 'Entity.php';

/**
 * Account 
 *
 * Encapsulates data about a Reddit account
 * 
 * "data": {
 *     "has_mail"      : false,
 *     "name"          : "username",
 *     "created"       : 1213716360.0,
 *     "modhash"       : "f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0",
 *     "created_utc"   : 1213716360.0,
 *     "link_karma"    : 5000,
 *     "comment_karma" : 10000,
 *     "is_gold"       : false,
 *     "is_mod"        : true,
 *     "id"            : "0ffff",
 *     "has_mod_mail"  : false
 * }
 * 
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @uses      \ArrayAccess
 */
class Account extends Entity {

	/**
	 * Returns the account's unique ID
	 * 
	 * @access public
	 * @return string
	 */
	public function getId()
	{
		return $this['id'];
	}

	/**
	 * Returns the user's name
	 * 
	 * @access public
	 * @return string
	 */
	public function getName()
	{
		return $this['name'];
	}

	/**
	 * Returns the account's comment karma
	 * 
	 * @access public
	 * @return integer
	 */
	public function getCommentKarma()
	{
		return $this['comment_karma'];
	}

	/**
	 * Returns the account's link karma
	 * 
	 * @access public
	 * @return integer
	 */
	public function getLinkKarma()
	{
		return $this['link_karma'];
	}

	/**
	 * Indicates whether the user is a moderator
	 * 
	 * @access public
	 * @return boolean
	 */
	public function isMod()
	{
		return isset($this['is_mod']) ? $this['is_mod'] : false;
	}

	/**
	 * Indicates whether the user has Reddit Gold
	 * 
	 * @access public
	 * @return boolean
	 */
	public function isGold()
	{
		return isset($this['is_gold']) ? $this['is_gold'] : false;
	}

	/**
	 * Indicates whether the user has mail
	 * 
	 * @access public
	 * @return boolean
	 */
	public function hasMail()
	{
		return isset($this['has_mail']) ? $this['has_mail'] : false;
	}

	/**
	 * Indicates whether the user has moderator mail
	 * 
	 * @access public
	 * @return boolean
	 */
	public function hasModMail()
	{
		return isset($this['has_mod_mail']) ? $this['has_mod_mail'] : false;
	}

	/**
	 * Returns an array of links posted by the user
	 * 
	 * @access public
	 * @return array
	 */
	public function getLinks()
	{
		$username = $this->getName();

		$links = $this->reddit->getLinksByUsername();
		return $links;
	}

}

