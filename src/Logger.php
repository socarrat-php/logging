<?php

namespace Socarrat\Logging;

abstract class Logger {
	abstract public function log(LogLevel $level, string $message);
}
