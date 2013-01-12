<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Link;

/**
 * LinkTest
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class LinkTest extends PHPUnit_Framework_TestCase
{

    private $link;

    public function setUp()
    {
        $this->link = new Link;
    }

    /**
     * Verifies the correctness of some methods that expose data
     */
    public function testGetters()
    {
        $this->link->setData(
            array(
                'id' => 'sdfgh',
                'ups' => 10,
                'downs' => 9,
                'score' => 9001,
                'num_comments' => 235,
                'author' => 'I_RAPE_CATS',
                'title' => 'IAMA unit test AMA',
                'url' => 'Edit: FRONT PAGE OMG! Edit: Its 2AM Im going to bed',
            )
        );

        $this->assertEquals('sdfgh', $this->link->getId());
        $this->assertEquals('10', $this->link->getUpvotes());
        $this->assertEquals('9', $this->link->getDownvotes());
        $this->assertEquals('9001', $this->link->getScore());
        $this->assertEquals('235', $this->link->countComments());
        $this->assertEquals('I_RAPE_CATS', $this->link->getAuthorName());
        $this->assertEquals('IAMA unit test AMA', $this->link->getTitle());
        $this->assertEquals('Edit: FRONT PAGE OMG! Edit: Its 2AM Im going to bed', $this->link->getUrl());
    }

    /**
     * Verifies that Link can correctly identify if it represents a self-post
     */
    public function testKnowsIfSelfPost()
    {
        $this->link->setData(array('is_self' => true));
        $this->assertTrue($this->link->isSelfPost());

        $this->link->setData(array('is_self' => false));
        $this->assertFalse($this->link->isSelfPost());
    }

    /**
     * Verifies that Link can correctly identify if it represents a hidden post
     */
    public function testKnowsIfHidden()
    {
        $this->assertFalse($this->link->isHidden());
        $this->link->setData(array('hidden' => true));
        $this->assertTrue($this->link->isHidden());
    }

    /**
     * Verifies that Link can correctly identify if it represents a saved post
     */
    public function testKnowsIfSaved()
    {
        $this->assertFalse($this->link->isSaved());
        $this->link->setData(array('saved' => true));
        $this->assertTrue($this->link->isSaved());
    }

    /**
     * Verifies that getPermalink() works correctly and can return the absolute
     * version of the URL if requested
     */
    public function testGetPermalink()
    {
        $this->assertEquals(null, $this->link->getPermalink());

        $this->link->setData(array('permalink' => '/r/programming'));

        $expectedRelative = '/r/programming';
        $expectedAbsolute = 'http://www.reddit.com/r/programming';

        $actualRelative = $this->link->getPermalink();
        $actualAbsolute = $this->link->getPermalink(true);

        $this->assertEquals($expectedRelative, $actualRelative);
        $this->assertEquals($expectedAbsolute, $actualAbsolute);
    }

    /**
     * Verifies that Links can tell if they're restricted to those over 18 years
     * of age
     */
    public function testKnowsIfAgeRestricted()
    {
        $this->assertFalse($this->link->isAgeRestricted());
        $this->link->setData(array('over18' => true));
        $this->assertTrue($this->link->isAgeRestricted());
    }

    /**
     * Verifies that Links can tell if the logged-in user has clicked on them
     */
    public function testKnowsIfClicked()
    {
        $this->assertFalse($this->link->isClicked());
        $this->link->setData(array('clicked' => true));
        $this->assertTrue($this->link->isClicked());
    }
}
