<?php


	namespace MehrIt\MonologDatadogFormatter;


	use Monolog\Formatter\JsonFormatter;

	class DatadogJsonFormatter extends JsonFormatter
	{
		public function __construct($batchMode = self::BATCH_MODE_JSON, $appendNewline = true, $includeStacktraces = true) {
			parent::__construct($batchMode, $appendNewline);

			// default include stacktraces to `true`
			$this->includeStacktraces = $includeStacktraces;
		}

		public function format(array $record) {

			// add timestamp
			if (isset($record["datetime"]) && ($record["datetime"] instanceof \DateTimeInterface)) {
				$record["timestamp"] = $record["datetime"]->format('Uv');
				unset($record["datetime"]);
			}

			// add PID
			if (!($record['pid'] ?? null) && extension_loaded('posix'))
				$record['pid'] = posix_getpid();

			return parent::format($record);
		}


	}