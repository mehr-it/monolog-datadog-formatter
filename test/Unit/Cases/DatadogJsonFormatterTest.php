<?php


	namespace MehrItMonologDatadogFormatterTest\Unit\Cases;


	use DateTime;
	use MehrIt\MonologDatadogFormatter\DatadogJsonFormatter;

	class DatadogJsonFormatterTest extends TestCase
	{

		public function testFormat_message() {

			$formatter = new DatadogJsonFormatter();

			$dt = new DateTime();

			$formatted = $formatter->format([
				'message'  => 'My message',
				'datetime' => $dt,
			]);


			$this->assertSame([
				'message'   => 'My message',
				'timestamp' => $dt->format('Uv'),
				'pid' => posix_getpid(),
			], json_decode($formatted, true));


		}

		public function testFormat_exception() {

			$formatter = new DatadogJsonFormatter();

			$ex = new \RuntimeException('ex');

			$dt = new DateTime();

			$formatted = $formatter->format([
				'context'  => $ex,
				'datetime' => $dt,
			]);


			$this->assertSame([
				'context'   => [
					'class'   => 'RuntimeException',
					'message' => 'ex',
					'code'    => 0,
					'file'    => $ex->getFile() . ':' . $ex->getLine(),
					'trace'   => array_map(function ($frame) {
						return $frame['file'] . ':' . $frame['line'];
					}, $ex->getTrace()),
				],
				'timestamp' => $dt->format('Uv'),
				'pid' => posix_getpid(),
			], json_decode($formatted, true));


		}

	}