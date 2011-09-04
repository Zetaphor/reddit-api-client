Introduction
------------

This is a PHP Reddit API client.


As a quick taster, here's some sample code:

    <?php
    
    require_once 'RedditApiClient/Reddit.php';
    use \RedditApiClient\Reddit;
    
    $reddit = new Reddit;
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

Pull requests are welcome by the way!


Examples
--------

Here's some code that uses the client to show the thread of comments on the top
link in /r/programming

    <?php
    
    require_once 'Reddit/Reddit.php';
    use \RedditApiClient\Reddit;
    
    
    $reddit   = new Reddit;
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
    
    	$authorName = $comment->getAuthorName();
    
    	echo $prefix, $authorName, "\n";
    	echo $prefix, str_pad('', strlen($authorName), '-'), "\n";
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
    
        a_redditor
        ----------
        You should crosspost to /r/gamedev.
    
            huntersd
            --------
            Done!
    
                alexanderpas
                ------------
                how about /r/gaming ?
    
                    Metsuro
                    -------
                    I put a xpost in /r/gaming.
                    
    
                    huntersd
                    --------
                    Done! 

    [truncated]




