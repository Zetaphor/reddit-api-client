<?php

namespace RedditApiClient;

require_once 'Entity.php';

/**
 * Comment 
 *
 * Encapsulates data about a comment
 *
 * [data] => Array
 * (
 *     [body]                   => raise RonPaulError("Sorry, there are too many crazy libertarians on the internet.")
 *     [subreddit_id]           => t5_2fwo
 *     [author_flair_css_class] =>
 *     [created]                => 1213800499
 *     [author_flair_text]      =>
 *     [downs]                  => 8
 *     [author]                 => mcfunley
 *     [created_utc]            => 1213800499
 *     [body_html]              => &lt;div class="md"&gt;&lt;pre&gt;&lt;code&gt;raise RonPaulError("Sorry, there are too many crazy libertarians on the internet.")
 *     [levenshtein]            =>
 *     [link_id]                => t3_6nw57
 *     [parent_id]              => t3_6nw57
 *     [likes]                  =>
 *     [replies]                => Array ()
 *     [id]                     => c04e7lk
 *     [subreddit]              => programming
 *     [ups]                    => 28
 *     [name]                   => t1_c04e7lk
 * )
 * 
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.00
 */
class Comment extends Entity {

	/**
	 * Returns the comment's unique ID
	 * 
	 * @access public
	 * @return string
	 */
	public function getId()
	{
		return $this['id'];
	}

	/**
	 * Returns the number of upvotes given to the comment
	 * 
	 * @access public
	 * @return integer
	 */
	public function getUpvotes()
	{
		return $this['ups'];
	}

	/**
	 * Returns the number of downvotes given to the comment
	 * 
	 * @access public
	 * @return integer
	 */
	public function getDownvotes()
	{
		return $this['downs'];
	}

	/**
	 * Returns the comment body text
	 * 
	 * @access public
	 * @return string
	 */
	public function getBody()
	{
		return $this['body'];
	}

	/**
	 * Returns the username of the author of the comment
	 * 
	 * @access public
	 * @return string
	 */
	public function getAuthorName()
	{
		return $this['author'];
	}

}

