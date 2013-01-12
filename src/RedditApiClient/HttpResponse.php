<?php

namespace RedditApiClient;

/**
 * HttpResponse
 *
 * Represents a response received from a server
 *
 * @author    Henry Smith <henry@henrysmith.org>
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.5.2
 */
class HttpResponse
{

    /**
     * Asssociative array of HTTP headers received
     *
     * @access private
     * @var    array
     */
    private $headers = array();

    /**
     * The body of the response
     *
     * @access private
     * @var    string
     */
    private $body;

    /**
     * @access public
     * @param  array $headers
     * @param  string $body
     */
    public function __construct(array $headers, $body)
    {
        $this->headers = $headers;
        $this->body    = $body;
    }

    /**
     * Returns the response header value of the given name
     *
     * @access public
     * @param  string $name
     * @return string
     */
    public function getHeader($name)
    {
        foreach ($this->headers as $header) {
            if (strpos($header, "{$name}:") === 0) {

                $prefixLength = strlen("{$name}:") + 1;

                $suffix = substr($header, $prefixLength);
                $suffix = rtrim($suffix);

                return $suffix;
            }
        }

    }

    /**
     * Returns all response headers
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns the body of the response
     *
     * @access public
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }
}
