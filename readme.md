# Socarrat\Logging

Robust logging for every application.

## Examples

```php
use Socarrat\Logging\Loggers\FileLogger;
use Socarrat\Logging\LoggingManager;
use Socarrat\Logging\LogLevel;

$fileLogger = new FileLogger(__DIR__."/logfile.log");
LoggingManager::setLogger($fileLogger);

LoggingManager::log(LogLevel::LOG_CRITICAL, "Hello CRITICAL");
LoggingManager::log(LogLevel::LOG_ERROR, "Hello ERROR");
LoggingManager::log(LogLevel::LOG_WARNING, "Hello WARNING");
LoggingManager::log(LogLevel::LOG_NOTICE, "Hello NOTICE");
LoggingManager::log(LogLevel::LOG_INFO, "Hello INFO");
LoggingManager::log(LogLevel::LOG_DEBUG, "Hello DEBUG");
```

See more examples in the [`examples/`](./examples/) directory.

## Built-in loggers

The following loggers are shipped with this library under the namespace `Socarrat\Logging\Loggers`. You could also implement your own loggers; see the [`Logger` interface](#abstract-class-socarratlogginglogger) and [`LoggingManager::setLogger`](#static-public-function-setloggerlogger-logger).

### `FileLogger`

Outputs logs into a file. Pass a file path to the constructor, or set it later on using `FileLogger::setFilepath`.

### `NullLogger`

This logger does nothing with the logs.

## API

### `class Socarrat\Logging\LoggingManager`

This is the central logging manager; you should use this to log things.

#### `static public function setLogger(Logger $logger)`

Sets the [logger](#abstract-class-socarratlogginglogger) instance to use. The default is [NullLogger](#nulllogger).

| Parameter name | Type     | Default value | Description                 |
|----------------|----------|---------------|-----------------------------|
| `$logger`      | `Logger` | -             | The logger instance to use. |

#### `static public function log(LogLevel $level, string $message)`

Logs the given message at the given log level using [the logger that has been set](#static-public-function-setloggerlogger-logger).

| Parameter name | Type       | Default value | Description                 |
|----------------|------------|---------------|-----------------------------|
| `$level`       | `LogLevel` | -             | The level at which to log.  |
| `$message`     | `string`   | -             | The log message.            |

### `abstract class Socarrat\Logging\Logger`

This is the base class for loggers. All loggers should extend it.

#### `abstract public function log(LogLevel $level, string $message)`

Logs the given message at the given log level. You should not call this directly, use [`LogManager::log`](#static-public-function-logloglevel-level-string-message) instead.

| Parameter name | Type       | Default value | Description                 |
|----------------|------------|---------------|-----------------------------|
| `$level`       | `LogLevel` | -             | The level at which to log.  |
| `$message`     | `string`   | -             | The log message.            |

### `enum Socarrat\Logging\LogLevel: int`

Contains the [RFC 5424](https://datatracker.ietf.org/doc/html/rfc5424) log levels, except Alert and Emergency. Those are left out for the sake of simplicity.

| Log level      | Situation                                  | ID  |
|----------------|--------------------------------------------|:---:|
| `LOG_CRITICAL` | Critical conditions.                       | `2` |
| `LOG_ERROR`    | Error conditions.                          | `3` |
| `LOG_WARNING`  | Warning conditions.                        | `4` |
| `LOG_NOTICE`   | Notice: normal but significant conditions. | `5` |
| `LOG_INFO`     | Informational messages.                    | `6` |
| `LOG_DEBUG`    | Debug-level messages.                      | `7` |
