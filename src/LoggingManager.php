<?php

namespace Socarrat\Logging;

class LoggingManager {
	private static array $loggers = array();
	private static LogLevel $minimumLogLevel = LogLevel::LOG_DEBUG;

	static public function addLogger(Logger $logger): int {
		array_push(static::$loggers, $logger);
		return count(static::$loggers) - 1;
	}

	static public function setMinimumLogLevel(LogLevel $level) {
		static::$minimumLogLevel = $level;
	}

	static public function log(LogLevel $level, string $message) {
		if ($level->toInt() > static::$minimumLogLevel->toInt()) {
			return;
		}

		foreach (static::$loggers as $logger) {
			$logger->log($level, $message);
		}
	}
}
