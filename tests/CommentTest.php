<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Comment;

/**
 * CommentTest
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class CommentTest extends PHPUnit_Framework_TestCase
{

    private $comment;

    public function setUp()
    {
        $this->comment = new Comment;
    }

    public function testGetters()
    {
        $this->comment->setData(
            array(
                'id' => 'aqwerty',
                'ups' => 10,
                'downs' => 3,
                'author' => 'someuser',
                'body' => 'NO U',
            )
        );

        $this->assertEquals('aqwerty', $this->comment->getId());
        $this->assertEquals('10', $this->comment->getUpvotes());
        $this->assertEquals('3', $this->comment->getDownvotes());
        $this->assertEquals('someuser', $this->comment->getAuthorName());
        $this->assertEquals('NO U', $this->comment->getBody());
    }

    public function testReplyHierarchy()
    {
        $this->comment->setData(
            array(
                'replies' => array(
                    'data' => array(
                        'children' => array(
                            array('data' => array(
                                'id' => 123456,
                            )),
                            array('data' => array(
                                'id' => 123457,
                            )),
                        ),
                    ),
                ),
            )
        );

        $this->assertEquals(2, $this->comment->countReplies());

        $replies = $this->comment->getReplies();

        $this->assertEquals(123456, $replies[0]->getId());
        $this->assertEquals(123457, $replies[1]->getId());

        $this->assertEquals($this->comment, $replies[0]->getParent());
        $this->assertEquals($this->comment, $replies[1]->getParent());
    }
}
