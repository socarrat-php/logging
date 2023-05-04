<?php

namespace Socarrat\Logging;

/** Logger is the logging interface. */
abstract class Logger {
	/**
	 * Logs a message.
	 *
	 * @param LogLevel $level The log level
	 * @param string $message The message to log
	 */
	abstract public function log(LogLevel $level, string $message);
}
