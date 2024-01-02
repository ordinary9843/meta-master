# Meta Master

[![build](https://github.com/ordinary9843/meta-master/actions/workflows/build.yml/badge.svg)](https://github.com/ordinary9843/meta-master/actions/workflows/build.yml)
[![codecov](https://codecov.io/gh/ordinary9843/meta-master/branch/master/graph/badge.svg?token=QKCE7LJISZ)](https://codecov.io/gh/ordinary9843/meta-master)

### Intro

Analyzing and crawling the meta tags of a static website.

## Requirements

This library has the following requirements:

- PHP 7.1+

## Installation

Require the package via composer:

```bash
composer require ordinary9843/meta-master
```

## Usage

Example usage:

```php
<?php
require './vendor/autoload.php';

use Ordinary9843\MetaMaster;

$metaMaster = new MetaMaster();

/**
 * Set connection time (in seconds).
 */
$metaMaster->setConnectTimeout(5);
$metaMaster->setTimeout(5);

/**
 * Analyzing the meta tags from website.
 *
 * Output: [
 *  'title' => '',
 *  'charset' => '',
 *  'keywords' => '',
 *  'description' => '',
 *  'viewport' => '',
 *  'author' => '',
 *  'copyright' => '',
 *  'robots' => '',
 *  'og' => [],
 *  'twitter' => []
 * ]
 */
$metaMaster->parse('https://github.com/ordinary9843');

/**
 * Get all messages.
 *
 * Output: [
 *  '[INFO] Message.',
 *  '[ERROR] Message.'
 * ]
 */
$metaMaster->getMessages();
```

## Testing

```bash
composer test
```

## Licenses

(The [MIT](http://www.opensource.org/licenses/mit-license.php) License)
