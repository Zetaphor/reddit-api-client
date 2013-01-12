<?php

namespace RedditApiClient;

/**
 * HttpRequest
 *
 * Builds a HTTP request to send to a server
 *
 * I've built this simple class rather than use curl or the pecl HttpRequest
 * class because I have been through the pain of writing an API client using
 * those libraries and then found I had to deploy it on a server that had
 * neither and it sucked. Plus we don't need all that much HTTP functionality
 * so it's easy to provide what little we do need.
 *
 * @author    Henry Smith <henry@henrysmith.org>
 * @copyright 2011 Henry Smith
 * @license   GPLv2.0
 * @package   Reddit API Client
 * @version   0.5.2
 */
class HttpRequest
{

    /**
     * The HTTP method to use for the request
     *
     * For example, GET or POST.
     *
     * @access private
     * @var    string
     */
    private $httpMethod;

    /**
     * The URL to send the request to
     *
     * @access private
     * @var    string
     */
    private $url;

    /**
     * Associative array of HTTP headers to send before the body of the request
     *
     * @access private
     * @var    array
     */
    private $headers = array();

    /**
     * Associative array of POST variables
     *
     * @access private
     * @var    array
     */
    private $postVariables = array();

    /**
     * Associative array of cookie values
     *
     * @access private
     * @var    array
     */
    private $cookies = array();

    /**
     * The body of the request
     *
     * @access private
     * @var    string
     */
    private $body;

    /**
     * Sets the type of HTTP method to be used in the request
     *
     * @access public
     * @param  string $httpMethod  e.g. 'GET', 'POST'
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * Sets the URL to send the request to
     *
     * @access public
     * @param  string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Sets a name-value pair as one of the HTTP headers to be sent with the8
     * request
     *
     * @access public
     * @param  string $name
     * @param  string $value
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * Sets a name-value pair as one of the cookies to be sent with the request
     *
     * @access public
     * @param  string $name
     * @param  string $value
     */
    public function setCookie($name, $value)
    {
        $this->cookies[$name] = $value;

        $cookieAscii = '';

        foreach ($this->cookies as $name => $value) {
            $cookieAscii .= " {$name}={$value};";
        }

        $this->setHeader('Cookie', $cookieAscii);
    }

    /**
     * Sets the given string as the body of the request
     *
     * @access public
     * @param  string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * Sets a name-value pair as one of the POST variables to be sent with the
     * request
     *
     * Calling this method also causes the request to become a POST request.
     *
     * @access public
     * @param  string $name
     * @param  string $value
     */
    public function setPostVariable($name, $value)
    {
        $this->sethttpMethod('POST');
        $this->postVariables[$name] = $value;
        $this->body = http_build_query($this->postVariables);
    }

    /**
     * Sends the request to its destination and returns the response
     *
     * @access public
     * @return HttpResponse
     */
    public function getResponse()
    {
        $parameters = array(
            'http' => array(
                'method'  => $this->httpMethod,
                'content' => $this->body,
                'header'  => $this->getHeadersAsAscii(),
            ),
        );

        $stream = stream_context_create($parameters);
        $handle = @fopen($this->url, 'rb', false, $stream);

        if (!is_resource($handle)) {
            return null;
        }

        $streamMetaData = stream_get_meta_data($handle);
        $streamContents = stream_get_contents($handle);

        $headers = $streamMetaData['wrapper_data'];
        $body    = $streamContents;

        $response = new HttpResponse($headers, $body);

        return $response;
    }

    /**
     * Converts the HTTP headers to an ASCII string for sending
     *
     * @access private
     * @return string
     */
    private function getHeadersAsAscii()
    {
        $headerAscii = '';

        foreach ($this->headers as $name => $value) {
            $headerAscii .= "{$name}: {$value}\r\n";
        }

        $headerAscii .= "\r\n";

        return $headerAscii;
    }
}
