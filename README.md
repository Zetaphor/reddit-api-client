Introduction
------------

This is a PHP Reddit API client.


As a quick taster, here's some sample code:

    <?php
    
    require_once 'Reddit/src/Reddit.php';
    use \RedditApiClient\Reddit;
    
    $reddit = new Reddit;
    $posts  = $reddit->getPostsBySubreddit('botcirclejerk');
    
    foreach ($posts as $post) {
        echo $post->getTitle(), "\n";
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

I haven't packaged this up in any way whatsoever yet. If you want to use it,
just download the code and require_once Reddit.php

The code has all been written on a MacBook using PHP 5.3.6. It should work fine
on other operating systems but I'm using namespaces so anything less than 5.3
is no good.

I've been burned too many times writing code that relied on the prescence of
either cURL or pecl_http, only to find out that they weren't available and
never would be in the production environment. This library has its own
little implementations of HttpRequest and HttpResponse to save you from the
usual "Hey this API client looks like it might work oh wait it depends on cURL
never mind" bullshit.


Development Status
------------------

As of 2011-09-03 this project is less than 24 hours old. I was looking at
Reddit's API documentation last night and realised I couldn't find a PHP
client for it.

I've unit-tested as much as I could be bothered too and for the most part this
is pretty robust code. The parts that are actually implemented are probably
safe for production use, the main reason not to at the moment is the sheer
lack of missing functionality.

Pull requests are welcome by the way!

