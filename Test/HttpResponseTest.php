<?php

namespace RedditApiClient\Test;

use \PHPUnit_Framework_TestCase;
use \RedditApiClient\HttpResponse;

/**
 * HttpResponseTest
 *
 * Tests HttpResponse's data encapsulation
 *
 * @author     Henry Smith <henry@henrysmith.org>
 * @copyright  2011 Henry Smith
 * @license    GPLv2.0
 * @package    Reddit API Client
 * @subpackage Test
 * @version    0.5.2
 */
class HttpResponseTest extends PHPUnit_Framework_TestCase
{

    /**
     * Verifies that the slightly unpleasant-looking string matching in
     * getHeader() actually works
     */
    public function testGetHeaderFindsCorrectHeader()
    {
        $headers = array(
            "X-Test-Header: 1122334455\r\n",
            "X-Test-Header-2: 99887744\r\n",
        );

        $response = new HttpResponse($headers, '');

        $this->assertEquals('1122334455', $response->getHeader('X-Test-Header'));
        $this->assertEquals('99887744', $response->getHeader('X-Test-Header-2'));
        $this->assertEquals(null, $response->getHeader('Content-Type'));
    }
}
