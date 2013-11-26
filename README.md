Reddit API Client
=================

[![Build Status](https://secure.travis-ci.org/h2s/reddit-api-client.png)](http://travis-ci.org/h2s/reddit-api-client)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/h2s/reddit-api-client/badges/quality-score.png?s=7f14544827eccb99214c30e2f71904b527941a96)](https://scrutinizer-ci.com/g/h2s/reddit-api-client/)

This is a PHP Reddit API client.


As a quick taster, here's some sample code:

```php
<?php
require 'vendor/autoload.php;

$clientFactory = new RedditApiClient\ClientFactory;
$client = $clientFactory->createClient();

$login = $client->getCommand('Login', array(
    'api_type' => 'json',
    'user'     => 'Example_User',
    'passwd'   => 'password123',
));

$response = $login->execute();
```

Installation
------------

This project is packaged with [Composer](http://getcomposer.org/). Add the
following the the `require` section of your project's `composer.json`:

    "h2s/reddit-api-client": "dev-master"

After that just run `php composer.phar update` and you're good to go! If you
have any trouble, or want more detail, I've set up a working example "[Reddit
Console](https://github.com/h2s/reddit-console)" project for reference purposes.

Development Status
------------------

This library exposes the majority of the functionality of the API.

Anything to do with 'flair' isn't supported, but I can't see much demand for
that functionality anyway, so I can't find the motivation to actully implement
it.

Submitting self-posts isn't working yet, which is the only important missing
feature left that I know of. I will remove this paragraph as soon as this is
resolved.

Pull requests are welcome by the way!

Contributing
------------

This is a fairly simple project so there aren't many guidelines. I've you've
fixed a bug or added a feature let's get it merged back in. There are only two
rules:

#### 1. Run the tests

    $ ./vendor/bin/phpunit

Please make sure the tests pass before submitting a pull request. Ideally, your
pull request should include one or more new tests for the bug fix or new
functionality you're introducing.

#### 2. Follow the PSR-2 style guide

    $ ./vendor/bin/phpcs --standard=PSR2 src/

This project complies with the
[PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)
standard. Your pull request is probably already within these guidelines but it's
good to double check.

License
-------

This project is licensed under the GNU GENERAL PUBLIC LICENSE Version 2.

