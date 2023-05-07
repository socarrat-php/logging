<?php

namespace Socarrat\Logging\Loggers;
use Socarrat\Logging\Logger;
use Socarrat\Logging\LogLevel;

class FileLogger extends Logger {
	private \Closure $getFilePath;

	function __construct(\Closure $getFilePath) {
		$this->getFilePath = $getFilePath;
	}

	public function setFilePathGetter(\Closure $getFilePath) {
		$this->getFilePath = $getFilePath;
	}

	public function log(LogLevel $level, string $message) {
		$date = date("Y-m-d H:i:s");
		$message = str_replace("\n", "\n\t", trim($message));
		$levelCode = $level->toString();

		file_put_contents(
			($this->getFilePath)($level, $message),
			"[$date] [$levelCode] $message\n",
			FILE_APPEND
		);
	}
}
