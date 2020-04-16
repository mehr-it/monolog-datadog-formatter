# Datadog formatter for Monolog
[![Latest Version on Packagist](https://img.shields.io/packagist/v/mehr-it/monolog-datadog-formatter.svg?style=flat-square)](https://packagist.org/packages/mehr-it/monolog-datadog-formatter)
[![Build Status](https://travis-ci.org/mehr-it/monolog-datadog-formatter.svg?branch=master)](https://travis-ci.org/mehr-it/monolog-datadog-formatter)
Simple JSON formatter for Monolog with Datadog. Simply does following:

* replace "datetime" with "timestamp" field
* include stacktrace by default
* add PID if available