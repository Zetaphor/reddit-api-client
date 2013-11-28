<?php
namespace Reddit\Api\Session;

use Reddit\Api\Session;

interface Storage
{
    public function storeSession(Session $session);
    public function retrieveSession($username);
}
