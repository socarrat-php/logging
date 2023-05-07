<?php

namespace Socarrat\Logging;
use Socarrat\Logging\Loggers\NullLogger;

class LoggingManager {
	private static array $loggers = array();

	static public function addLogger(Logger $logger): int {
		array_push(static::$loggers, $logger);
		return count(static::$loggers) - 1;
	}

	static public function log(LogLevel $level, string $message) {
		foreach (static::$loggers as $logger) {
			$logger->log($level, $message);
		}
	}
}
