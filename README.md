Reddit API Client
=================

[![Build Status](https://travis-ci.org/Zetaphor/reddit-api-client.svg?branch=master)](https://travis-ci.org/Zetaphor/reddit-api-client)
[![Latest Stable Version](https://img.shields.io/packagist/v/zetaphor/reddit-api-client.svg)](https://packagist.org/packages/zetaphor/reddit-api-client)
[![Latest Stable Version](https://img.shields.io/packagist/l/zetaphor/reddit-api-client.svg)](https://packagist.org/packages/zetaphor/reddit-api-client)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.3-8892BF.svg)](https://php.net/)



This is a PHP client for [Reddit's API](http://www.reddit.com/dev/api), built on
the [Guzzle web service client framework](http://docs.guzzlephp.org/en/latest/).

As a quick taster, here's some sample code:

```php
<?php
require 'vendor/autoload.php';

$clientFactory = new Reddit\Api\Client\Factory;
$client = $clientFactory->createClient();

$login = $client->getCommand(
    'Login',
    array(
        'api_type' => 'json',
        'user'     => 'Example_User',
        'passwd'   => 'password123',
    )
);
$login->execute();

$submit = $client->getCommand(
    'Submit',
    array(
        'sr'    => 'programming',
        'kind'  => 'link',
        'title' => 'Mongo DB Is Web Scale',
        'url'   => 'http://www.youtube.com/watch?v=b2F-DItXtZs',
    )
);
$submit->execute();
```

Installation
------------

This project is packaged with [Composer](http://getcomposer.org/). Add the
following the the `require` section of your project's `composer.json`:

    "zetaphor/reddit-api-client": "dev-master"

After that just run `php composer.phar update` and you're good to go! If you
have any trouble, or want more detail, I've set up a working example "[Reddit
Console](https://github.com/hnrysmth/reddit-console)" project for reference purposes.

Development Status
------------------

Reddit's API is big, and the service description JSON in the
[`./api/`](https://github.com/zetaphor/reddit-api-client/tree/master/api) directory
is incomplete.

#### Supported URIs

* `api/login/{user}`
* `api/me.json`
* `api/register`
* `api/submit`
* `api/del`
* `api/vote`
* `api/comment`
* `api/message`
* `by_id/t3_{id}.json`
* `r/{subreddit}.json`
* `user/{id}.json`
* `user/{id}/about.json`

The above list covers many of the most common interactions such as logging in,
reading and posting links and comments, and casting votes. However, there are
dozens more services available in Reddit's API, and simple pull requests adding
entries to the service description JSON are very welcome.

Contributing
------------

This is a fairly simple project so there aren't many guidelines. I've you've
fixed a bug or added a feature, let's get it merged back in. There are two hard
rules.

#### 1. Test-drive your changes

This project is test-driven. Please don't submit any code changes without a
corresponding set of unit tests.

```bash
$ make phpunit
```

#### 2. Follow PSR2

Stick to the [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
standard.

```bash
$ make phpcs
```

License
-------

This project is released under the [MIT License].

[MIT License]: http://www.opensource.org/licenses/MIT
