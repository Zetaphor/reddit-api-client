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
 * @version   0.5.2
 */
class Comment extends Entity {

	/**
	 * An array of comments in reply to this one
	 * 
	 * @access private
	 * @var    array
	 */
	private $replies = array();

	/**
	 * The comment's parent, if it has one
	 * 
	 * @access private
	 * @var    \RedditApiClient\Comment
	 */
	private $parentComment;

	/**
	 * Returns the number of replies received by the comment
	 * 
	 * @access public
	 * @return integer
	 */
	public function countReplies()
	{
		return count($this->replies);
	}

	/**
	 * Returns the comment's unique 't1_*' style ID
	 * 
	 * @access public
	 * @return string
	 */
	public function getThingId()
	{
		return $this['name'];
	}

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

	/**
	 * Returns an array of the replies to the comment
	 * 
	 * @access public
	 * @return array
	 */
	public function getReplies()
	{
		return $this->replies;
	}

	/**
	 * Returns the comment's parent
	 * 
	 * @access public
	 * @return \RedditApiClient\Comment
	 */
	public function getParent()
	{
		return $this->parentComment;
	}

	/**
	 * Overrides Entity's setData to process the replies and package them as
	 * objects
	 * 
	 * @access public
	 * @param  array $data 
	 */
	public function setData(array $data)
	{
		parent::setData($data);

		if (isset($data['replies']['data']['children'])) {
			foreach ($data['replies']['data']['children'] as $reply) {

				$comment = new self($this->reddit);
				$comment->setData($reply['data']);
				$comment->setParent($this);

				$this->replies[] = $comment;

			}
		}

	}

	/**
	 * Sets the comment's parent
	 * 
	 * @access public
	 * @param  \RedditApiClient\Comment $parentComment 
	 */
	public function setParent($parentComment)
	{
		$this->parentComment = $parentComment;
	}

	/**
	 * Casts a vote on the comment
	 * 
	 * @access public
	 * @param  integer $direction  1 for upvote, -1 for down, 0 to remove vote
	 * @return boolean
	 */
	public function vote($direction)
	{
		$thingId = $this->getThingId();

		return $this->reddit->vote($thingId, $direction);
	}

	/**
	 * Posts a reply to the comment
	 * 
	 * @access public
	 * @param  string $text 
	 * @return boolean
	 */
	public function reply($text)
	{
		$thingId = $this->getThingId();

		return $this->reddit->comment($thingId, $text);
	}

	/**
	 * Saves the comment for the logged-in user
	 * 
	 * @access public
	 * @return boolean
	 */
	public function save()
	{
		$thingId = $this->getThingId();

		return $this->reddit->save($thingId);
	}

	/**
	 * Unsaves the comment for the logged-in user
	 * 
	 * @access public
	 * @return boolean
	 */
	public function unsave()
	{
		$thingId = $this->getThingId();

		return $this->reddit->unsave($thingId);
	}

	/**
	 * Hides a comment for the logged-in user
	 * 
	 * @access public
	 * @return boolean
	 */
	public function hide()
	{
		$thingId = $this->getThingId();

		return $this->reddit->hide($thingId);
	}

	/**
	 * Unhides a comment for the logged-in user
	 * 
	 * @access public
	 * @return boolean
	 */
	public function unhide()
	{
		$thingId = $this->getThingId();

		return $this->reddit->unhide($thingId);
	}

}

