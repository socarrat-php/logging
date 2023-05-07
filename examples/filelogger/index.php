<?php

require __DIR__."/../../vendor/autoload.php";
use Socarrat\Logging\Loggers\FileLogger;
use Socarrat\Logging\LoggingManager;
use Socarrat\Logging\LogLevel;

$fileLogger = new FileLogger(
	getFilePath: function(LogLevel $level, string $msg) {
		$l = strtolower($level->toString());
		return __DIR__."/test.$l.log";
	}
);

LoggingManager::addLogger($fileLogger);
LoggingManager::setMinimumLogLevel(LogLevel::LOG_WARNING);

LoggingManager::log(LogLevel::LOG_CRITICAL, "Hello CRITICAL"); //=> logs to test.critical.log
LoggingManager::log(LogLevel::LOG_ERROR, "Hello ERROR");       //=> logs to test.debug.log
LoggingManager::log(LogLevel::LOG_WARNING, "Hello WARNING");   //=> logs to test.warning.log

LoggingManager::log(LogLevel::LOG_NOTICE, "Hello NOTICE");     //=> will not be logged due to minimum log level log
LoggingManager::log(LogLevel::LOG_INFO, "Hello INFO");         //=> will not be logged
LoggingManager::log(LogLevel::LOG_DEBUG, "Hello DEBUG");       //=> will not be logged
