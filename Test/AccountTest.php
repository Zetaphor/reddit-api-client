<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\Account;

/**
 * AccountTest
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class AccountTest extends PHPUnit_Framework_TestCase
{

    private $account;

    public function setUp()
    {
        $this->account = new Account;
    }

    public function testGetters()
    {
        $this->account->setData(
            array(
                'id' => 'aqwerty',
                'name' => 'I_RAPE_CATS',
                'comment_karma' => 1,
                'link_karma' => 2,
            )
        );

        $this->assertEquals('aqwerty', $this->account->getId());
        $this->assertEquals('I_RAPE_CATS', $this->account->getName());
        $this->assertEquals('1', $this->account->getCommentKarma());
        $this->assertEquals('2', $this->account->getLinkKarma());
    }

    public function testKnowsIfMod()
    {
        $this->assertFalse($this->account->isMod());
        $this->account->setData(array('is_mod' => true));
        $this->assertTrue($this->account->isMod());
    }

    public function testKnowsIfGold()
    {
        $this->assertFalse($this->account->isGold());
        $this->account->setData(array('is_gold' => true));
        $this->assertTrue($this->account->isGold());
    }

    public function testKnowsIfHasMail()
    {
        $this->assertFalse($this->account->hasMail());
        $this->account->setData(array('has_mail' => true));
        $this->assertTrue($this->account->hasMail());
    }

    public function testKnowsIfHasModMail()
    {
        $this->assertFalse($this->account->hasModMail());
        $this->account->setData(array('has_mod_mail' => true));
        $this->assertTrue($this->account->hasModMail());
    }
}
