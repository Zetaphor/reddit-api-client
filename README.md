Reddit API Client
=================

[![Build Status](https://secure.travis-ci.org/h2s/reddit-api-client.png)](http://travis-ci.org/h2s/reddit-api-client)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/h2s/reddit-api-client/badges/quality-score.png?s=7f14544827eccb99214c30e2f71904b527941a96)](https://scrutinizer-ci.com/g/h2s/reddit-api-client/)

This is a PHP Reddit API client.


As a quick taster, here's some sample code:

    <?php
    
    require 'vendor/autoload.php';

    $reddit = new RedditApiClient\Reddit;
    $links  = $reddit->getLinksBySubreddit('botcirclejerk');
    
    foreach ($links as $link) {
        echo $link->getTitle(), "\n";
    }

And this is its output:

    Wtf is up FUCK YOU BADGERS.
    UPVOTE ME
    So he fucking HATES me...not a very hard time communicating their thought process "well then have a boat, he can just use water. Take care of those people who walk in the room.
    SOME MONDAY NIGHT, WE SHOULD REFUSE SHOWERS AND BATHS FOR MONTHS.
    Blah blah stds blah blah blah blah blah stds blah blah blah blah.
    CHICK WITH A DIAMOND SHOVEL, EARLY IN THY MORNING?
    Argh damn freaking fracking fuck.
    and thus begins scene 4: Tttttttttttttttt 5: ????? step 6: I live with daily floor washing robot
    woopwoop pull ova  dat ass too fat
    [citation needed] I was walking into my neighbor's cat pissed a bitch asshole. 
    （╯°□°）╯︵ ┻━┻ （╯°□°）╯︵ ┻━┻ FREE KARMA.

For more details of how to use this library, [see the Wiki](https://github.com/henry-smith/Reddit-API-Client/wiki)

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


Examples
--------

Here's some code that uses the client to show the thread of comments on the top
link in /r/programming

    <?php
    
    require_once 'vendor/autoload';
    
    $reddit   = new RedditApiClient\Reddit;
    $proggit  = $reddit->getLinksBySubreddit('programming');
    $topLink  = $proggit[0];
    $comments = $topLink->getComments();
    
    echo $topLink->getTitle(), "\n\n";
    
    foreach ($comments as $comment) {
    	showComment($comment);
    }
    
    function showComment($comment, $level = 1)
    {
    	$prefix = str_pad('', $level * 4, ' ');
    
    	$body = $comment->getBody();
    	$body = wordwrap($body, 80 - strlen($prefix), "\n", true);
    	$body = str_replace("\n", "\n{$prefix}", $body);
    
    	echo $prefix, $body, "\n\n";
    
    	$replies = $comment->getReplies();
    
    	foreach ($replies as $reply) {
    		showComment($reply, $level + 1);
    	}
    }

And here's the output:

    We're developing a complete RPG in 14 days, live 
    streaming 24 hours a day, to raise money for 
    Child's Play. Watch me code it in real time!
    
        You should crosspost to /r/gamedev.
    
            Done!
    
                how about /r/gaming ?
    
                    I put a xpost in /r/gaming.
                    

    [truncated]

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

