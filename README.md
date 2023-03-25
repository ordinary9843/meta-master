# MetaMaster

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

// Set connection time (in seconds).
$metaMaster->setConnectTimeout(10);
$metaMaster->setTimeout(10);

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
 *  'links' => [],
 *  'css' => [],
 *  'js' => [],
 *  'icons' => [],
 *  'images' => [],
 *  'facebook' => [],
 *  'twitter' => []
 * ]
 */
$metaMaster->parse('https://github.com/ordinary9843/meta-master');

/**
 * Get error message.
 *
 * Output: 'Any error message.'
 */
$metaMaster->getError();
```

## Testing

```bash
composer test
```

## Licenses

(The [MIT](http://www.opensource.org/licenses/mit-license.php) License)

Copyright &copy; [Jerry Chen](https://ordinary9843.medium.com/)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE
