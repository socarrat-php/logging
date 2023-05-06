<?php

namespace Socarrat\Logging\Loggers;
use Socarrat\Logging\Logger;
use Socarrat\Logging\LogLevel;

class FileLogger extends Logger {
	private string $filepath;

	function __construct(string $filepath) {
		$this->filepath = $filepath;
	}

	public function setFilepath(string $filepath) {
		$this->filepath = $filepath;
	}

	public function log(LogLevel $level, string $message) {
		$date = date("Y-m-d H:i:s");
		$message = str_replace("\n", "\n\t", trim($message));
		$levelCode = $level->toString();

		file_put_contents(
			$this->filepath,
			"[$date] [$levelCode] $message\n",
			FILE_APPEND
		);
	}
}
