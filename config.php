<?php
return array(
    'server'   => 'irc.quakenet.org',
    'port'     => 6667,
    'name'     => 'Bazinga',
    'nick'     => 'Bazinga',
    'channels' => array(
        '#xstyled',
    ),
    'max_reconnects' => 1,
    'log_file'       => 'log.txt',
    'commands'       => array(
        'Command\Say'     => array(),
        'Command\Weather' => array(
            'yahooKey' => 'a',
        ),
        'Command\Joke'    => array(),
        'Command\Ip'      => array(),
        'Command\Imdb'    => array(),
        'Command\Poke'    => array(),
        'Command\Join'    => array(),
        'Command\Part'    => array(),
        'Command\Timeout' => array(),
        'Command\Quit'    => array(),
        'Command\Restart' => array(),
	'Command\Php'	  => array(),
	'Command\Excuses' => array(),
    ),
    'listeners' => array(
        'Listener\Joins' => array(),
	'Listener\Youtube' => array(),
    ),
);
