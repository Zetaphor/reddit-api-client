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


