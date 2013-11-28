<?php
namespace Reddit\Session\Storage;

use Reddit\Session;

class Disk implements Session\Storage
{
	private $directory;

	public function __construct($directory = '/tmp')
	{
		$this->directory = rtrim($directory, DIRECTORY_SEPARATOR);
	}

	public function storeSession(Session $session)
	{
		$filename = $this->generateFilename($session->getUsername());
		file_put_contents($filename, serialize($session));
	}

	public function retrieveSession($username)
	{
		$filename = $this->generateFilename($username);
		if (file_exists($filename)) {
			$contents = file_get_contents($filename);
			$session = unserialize($contents);
			return $session;
		}
	}

	private function generateFilename($username)
	{
		return implode(
			DIRECTORY_SEPARATOR,
			array(
				$this->directory,
				$username
			)
		);
	}
}

