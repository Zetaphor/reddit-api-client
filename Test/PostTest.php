<?php

namespace RedditApiClient\Test;

require_once '../Post.php';
require_once 'PHPUnit/Framework/TestCase.php';

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Post;

/**
 * PostTest 
 *
 * @author    Henry Smith <henry@henrysmith.org> 
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.00
 */
class PostTest extends PHPUnit_Framework_TestCase {

	private $post;

	public function setUp()
	{
		$this->post = new Post;
	}

	/**
	 * Verifies the correctness of some methods that expose data
	 */
	public function testGetters()
	{
		$this->post->setData(array(
			'id' => 'sdfgh',
			'ups' => 10,
			'downs' => 9,
			'score' => 9001,
			'num_comments' => 235,
			'author' => 'I_RAPE_CATS',
			'title' => 'IAMA unit test AMA',
			'url' => 'Edit: FRONT PAGE OMG! Edit: Its 2AM Im going to bed',
		));

		$this->assertEquals('sdfgh', $this->post->getId());
		$this->assertEquals('10', $this->post->getUpvotes());
		$this->assertEquals('9', $this->post->getDownvotes());
		$this->assertEquals('9001', $this->post->getScore());
		$this->assertEquals('235', $this->post->countComments());
		$this->assertEquals('I_RAPE_CATS', $this->post->getAuthorName());
		$this->assertEquals('IAMA unit test AMA', $this->post->getTitle());
		$this->assertEquals('Edit: FRONT PAGE OMG! Edit: Its 2AM Im going to bed', $this->post->getUrl());
	}

	/**
	 * Verifies that Post can correctly identify if it represents a self-post
	 */
	public function testKnowsIfSelfPost()
	{
		$this->post->setData(array('is_self' => true));
		$this->assertTrue($this->post->isSelfPost());

		$this->post->setData(array('is_self' => false));
		$this->assertFalse($this->post->isSelfPost());
	}

}

