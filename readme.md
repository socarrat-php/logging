# Socarrat\Logging

Robust logging library for every application.

## Examples

```php
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

LoggingManager::log(LogLevel::LOG_CRITICAL, "Hello CRITICAL"); //=> logs to test.critical.log
LoggingManager::log(LogLevel::LOG_DEBUG, "Hello DEBUG");       //=> logs to test.debug.log
```

You can find the output of this script [here](./examples/filelogger/). See more examples in the [`examples/`](./examples/) directory.

## Built-in loggers

The following loggers are shipped with this library under the namespace `Socarrat\Logging\Loggers`. You could also implement your own loggers; see the [`Logger` interface](#abstract-class-socarratlogginglogger) and [`LoggingManager::addLogger`](#static-public-function-addloggerlogger-logger-int).

### `FileLogger`

Outputs logs into a file.

#### `new FileLogger(\Closure $getFilePath)`

Constructs a new file logger. You can pass a closure into the constructor, which is called on each log and returns the filename the log should be sent to. It receives two positional arguments: the [`LogLevel`](#enum-socarratloggingloglevel-int) and the string to log.

You can replace the filepath getter later on by calling `FileLogger::setFilePathGetter(\Closure $getFilePath)`.

### `NullLogger`

This logger does nothing with the logs.

## API

### `class Socarrat\Logging\LoggingManager`

This is the central logging manager; you should use this to log things.

#### `static public function addLogger(Logger $logger): int`

Adds a [logger](#abstract-class-socarratlogginglogger) instance to use. Returns the index which has been assigned to the logger. If multiple loggers have been set, each of them is called.

| Parameter name | Type     | Default value | Description                 |
|----------------|----------|---------------|-----------------------------|
| `$logger`      | `Logger` | -             | The logger instance to add. |

#### `static public function log(LogLevel $level, string $message)`

Logs the given message at the given log level using [the logger that has been set](#static-public-function-addloggerlogger-logger-int). If multiple loggers have been set, each of them is called.

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

Contains the [RFC 5424](https://datatracker.ietf.org/doc/html/rfc5424) log levels.

| Log level       | Situation                                  | ID  |
|-----------------|--------------------------------------------|:---:|
| `LOG_EMERGENCY` | System is unusable.                        | `2` |
| `LOG_ALERT`     | Action must be taken immediately.          | `2` |
| `LOG_CRITICAL`  | Critical conditions.                       | `2` |
| `LOG_ERROR`     | Error conditions.                          | `3` |
| `LOG_WARNING`   | Warning conditions.                        | `4` |
| `LOG_NOTICE`    | Notice: normal but significant conditions. | `5` |
| `LOG_INFO`      | Informational messages.                    | `6` |
| `LOG_DEBUG`     | Debug-level messages.                      | `7` |

`LogLevel::toString()` will return the stringified version of the log level, e.g. calling `(LogLevel::LOG_ALERT)->toString()` will result in `ALERT`.

## Copyright

(c) 2023 Romein van Buren. Licensed under the MIT license.

For the full copyright and license information, please view the [`license.md`](./license.md) file that was distributed with this source code.
