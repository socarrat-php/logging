<?php

require __DIR__."/../../vendor/autoload.php";
use Socarrat\Logging\Loggers\FileLogger;
use Socarrat\Logging\LoggingManager;
use Socarrat\Logging\LogLevel;

$fileLogger = new FileLogger(getFilePath: function(LogLevel $level, string $msg) {
	$l = strtolower($level->toString());
	return __DIR__."/test.$l.log";
});

LoggingManager::addLogger($fileLogger);

LoggingManager::log(LogLevel::LOG_CRITICAL, "Hello CRITICAL");
LoggingManager::log(LogLevel::LOG_ERROR, "Hello ERROR");
LoggingManager::log(LogLevel::LOG_WARNING, "Hello WARNING");
LoggingManager::log(LogLevel::LOG_NOTICE, "Hello NOTICE");
LoggingManager::log(LogLevel::LOG_INFO, "Hello INFO");
LoggingManager::log(LogLevel::LOG_DEBUG, "Hello DEBUG");
