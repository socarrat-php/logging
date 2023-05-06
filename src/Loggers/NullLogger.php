<?php

namespace Socarrat\Logging\Loggers;
use Socarrat\Logging\Logger;
use Socarrat\Logging\LogLevel;

class NullLogger extends Logger {
	public function log(LogLevel $level, string $message) {}
}
