<?php
return array(
    'server'   => 'irc.quakenet.org',
    'port'     => 6667,
    'name'     => 'B0tn4me',
    'nick'     => 'B0tn4me',
    'channels' => array(
        '#channel',
    ),
    'max_reconnects' => 1,
    'log_file'       => 'log.txt',
    'commands'       => array(
        'Command\Say'     => array(),
        'Command\Weather' => array(
            'yahooKey' => 'youryahooapikey',
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
	'Command\Php'	  => array('execDir' => '/your/path/get/files/php'),
	'Command\Excuses' => array(),
	'Command\Commands' => array(),
	'Command\Wiki' => array(),
	'Command\Update' => array(),
    ),
    'listeners' => array(
        'Listener\Joins' => array(),
	'Listener\Youtube' => array(),
    ),
);
