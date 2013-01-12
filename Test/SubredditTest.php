<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Subreddit;

/**
 * SubredditTest
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class SubredditTest extends PHPUnit_Framework_TestCase
{

    private $subreddit;

    public function setUp()
    {
        $this->subreddit = new Subreddit;
    }

    public function testGetters()
    {
        $this->subreddit->setData(
            array(
                'display_name' => 'Ubuntu',
                'title'        => 'Ubuntu Linux',
                'subscribers'  => 9001,
                'id'           => 'qwerty',
                'description'  => 'Linux For Noobs',
            )
        );

        $this->assertEquals('Ubuntu', $this->subreddit->getDisplayName());
        $this->assertEquals('Ubuntu Linux', $this->subreddit->getTitle());
        $this->assertEquals('9001', $this->subreddit->getSubscribers());
        $this->assertEquals('qwerty', $this->subreddit->getId());
        $this->assertEquals('Linux For Noobs', $this->subreddit->getDescription());
    }

    public function testKnowsIfAgeRestricted()
    {
        $this->assertFalse($this->subreddit->isAgeRestricted());
        $this->subreddit->setData(
            array(
                'over18' => true,
            )
        );
        $this->assertTrue($this->subreddit->isAgeRestricted());
    }
}
