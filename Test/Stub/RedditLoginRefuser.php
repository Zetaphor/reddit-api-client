<?php

namespace RedditApiClient\Test;

use \RedditApiClient\Reddit;

/**
 * Stub_RedditLoginRefuser
 *
 * The sole purpose of this class is to return false to all login attempts to
 * help test the error handling for that case
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @uses       \RedditApiClient\Reddit
 * @version    0.5.2
 */
class Stub_RedditLoginRefuser extends Reddit
{

    public function login()
    {
        return false;
    }
}
