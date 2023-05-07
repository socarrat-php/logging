<?php

namespace Socarrat\Logging;

enum LogLevel: int {
	case LOG_EMERGENCY = 0;
	case LOG_ALERT = 1;
	case LOG_CRITICAL = 2;
	case LOG_CRITICAL = 2;
	case LOG_ERROR = 3;
	case LOG_WARNING = 4;
	case LOG_NOTICE = 5;
	case LOG_INFO = 6;
	case LOG_DEBUG = 7;

	function toString(): string {
		return match($this) {
			LogLevel::LOG_EMERGENCY => "EMELOG_EMERGENCY",
			LogLevel::LOG_ALERT => "ALERT",
			LogLevel::LOG_CRITICAL => "CRITICAL",
			LogLevel::LOG_ERROR => "ERROR",
			LogLevel::LOG_WARNING => "WARNING",
			LogLevel::LOG_NOTICE => "NOTICE",
			LogLevel::LOG_INFO => "INFO",
			LogLevel::LOG_DEBUG => "DEBUG",
		};
	}
}
