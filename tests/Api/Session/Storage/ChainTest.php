<?php
namespace Reddit\Test\Api\Session\Storage;

use Mockery as m;
use PHPUnit_Framework_TestCase;
use Reddit\Api\Session;

class ChainTest extends PHPUnit_Framework_TestCase
{
    private $chain;
    private $session;
    private $firstImplementation;
    private $secondImplementation;

    public function setUp()
    {
        parent::setUp();
        $this->session = new Session('exampleuser', 'swordfish', 'poiu');
        $this->firstImplementation = m::mock('Reddit\Session\Storage');
        $this->secondImplementation = m::mock('Reddit\Session\Storage');
        $this->chain = new Session\Storage\Chain(
            array(
                $this->firstImplementation,
                $this->secondImplementation
            )
        );
    }

    /**
     * @test
     */
    public function storeSession()
    {
        $this->firstImplementation
            ->shouldReceive('storeSession')
            ->with($this->session)
            ->once();

        $this->secondImplementation
            ->shouldReceive('storeSession')
            ->with($this->session)
            ->once();

        $this->chain->storeSession($this->session);
    }

    /**
     * @test
     */
    public function retrieveSessionStopsWhenFound()
    {
        $this->firstImplementation
            ->shouldReceive('retrieveSession')
            ->with('example')
            ->andReturn($this->session)
            ->once();

        $session = $this->chain->retrieveSession('example');
        $this->assertEquals($this->session, $session);
    }
}

