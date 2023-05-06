<?php

namespace Socarrat\Logging;
use Socarrat\Logging\Loggers\NullLogger;

class LoggingManager {
	private static Logger $logger;

	static public function setLogger(Logger $logger) {
		static::$logger = $logger;
	}

	static public function log(LogLevel $level, string $message) {
		if (!isset(static::$logger)) {
			static::$logger = new NullLogger();
		}
		static::$logger->log($level, $message);
	}
}
