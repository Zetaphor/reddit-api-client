<?php

namespace RedditApiClient;

use \Exception;

/**
 * RedditException
 *
 * Defines the types of exception that can be thrown by the API client
 *
 * @author    Henry Smith <henry@henrysmith.org>
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @uses      \Exception
 * @version   0.5.2
 */
class RedditException extends Exception
{

    /**
     * Denotes that the exception was thrown because an attempt was made to login
     * and the attempt failed
     */
    const UNABLE_TO_LOGIN = 1;

    /**
     * Denotes that the exception was thrown because an attempt was made to
     * perform an action that requires a logged in client, but the client wasn't
     * logged in
     */
    const LOGIN_REQUIRED = 2;

    /**
     * Denotes that the exception was thrown because an attempt was made to
     * load content from a nonexistent subreddit
     */
    const NO_SUCH_SUBREDDIT = 3;
}
