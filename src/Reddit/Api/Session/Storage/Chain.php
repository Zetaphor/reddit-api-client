<?php
namespace Reddit\Api\Session\Storage;

use Reddit\Api\Session;

class Chain implements Session\Storage
{
    private $storageImplementations = array();

    public function __construct(array $storageImplementations = array())
    {
        $this->storageImplementations = $storageImplementations;
    }

    public function storeSession(Session $session)
    {
        foreach ($this->storageImplementations as $storage) {
            $storage->storeSession($session);
        }
    }

    public function retrieveSession($username)
    {
        foreach ($this->storageImplementations as $storage) {
            $session = $storage->retrieveSession($username);
            if ($session instanceof Session) {
                return $session;
            }
        }
    }
}
