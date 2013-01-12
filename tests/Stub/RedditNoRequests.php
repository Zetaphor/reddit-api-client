<?php

namespace RedditApiClient\Test;

use \RedditApiClient\Reddit;

/**
 * Stub_RedditNoRequests
 *
 * The purpose of this stub is to provide a Reddit object that can be used for
 * tests with a guarantee that it will never send a HTTP request to anyone
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @uses       \RedditApiClient\Reddit
 * @version    0.5.2
 */
class Stub_RedditNoRequests extends Reddit
{

    public function login()
    {
        return false;
    }

    public function sendRequest($verb, $url, $body = '')
    {
        return null;
    }
}
