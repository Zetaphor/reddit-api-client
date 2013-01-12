<?php

namespace RedditApiClient\Test;

use \RedditApiClient\Reddit;
use \RedditApiClient\RedditException;
use \PHPUnit_Framework_TestCase;

/**
 * RedditExceptionTest
 *
 * Verifies that exceptions are thrown correctly by the API client
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @uses       \PHPUnit_Framework_TestCase
 * @uses       \RedditApiClient\Reddit
 * @uses       \RedditApiClient\RedditException
 * @version    0.5.2
 */
class RedditExceptionTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests to make sure that UNABLE_TO_LOGIN exceptions are thrown as expected
     */
    public function testBadLoginThrowsException()
    {
        $code = null;

        try {
            new Stub_RedditLoginRefuser('invalid user', 'invalid password');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::UNABLE_TO_LOGIN, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to post when not logged in
     */
    public function testExceptionIfPostingWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->comment('asdfgh', 'test comment');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to vote when not logged in
     */
    public function testExceptionIfVotingWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->vote('asdfgh', 1);
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to list subscribed subreddits when not logged in
     */
    public function testExceptionIfListingSubscriptionsWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->getMySubreddits();
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to save posts when not logged in
     */
    public function testExceptionIfSavingPostWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->save('asaas');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to unsave posts when not logged in
     */
    public function testExceptionIfUnsavingPostWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->unsave('asaas');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to hide posts when not logged in
     */
    public function testExceptionIfHidingPostWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->hide('asaas');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to unhide posts when not logged in
     */
    public function testExceptionIfUnhdingPostWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->unhide('asaas');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }

    /**
     * Tests to make sure that LOGIN_REQUIRED exceptions are thrown if attempting
     * to submit links when not logged in
     */
    public function testExceptionIfSubmittingLinkWhileNotLoggedIn()
    {
        $code = null;

        $reddit = new Stub_RedditNoRequests;

        try {
            $reddit->submit('pics', 'link', 'Nailed It', 'http://imgur.com/112345');
        } catch (RedditException $e) {
            $code = $e->getCode();
        }

        $this->assertEquals(RedditException::LOGIN_REQUIRED, $code);
    }
}
