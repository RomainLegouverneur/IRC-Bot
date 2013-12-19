<?php
// Namespace
namespace Command;

/**
 * Sends a Developer Excuse to channel.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Humberto Pereira (https://github.com/begnini)
 *
 */
class Excuses extends \Library\IRC\Command\Base {
    /**
     * The command's help text.
     *
     * @var string
     */
    protected $help = '!excuses';

    private $url = 'http://developerexcuses.com/';

    /**
     * The number of arguments the command needs.
     *
     * @var integer
     */
    protected $numberOfArguments = 0;

    /**
     * Sends the arguments to the channel. A random excuse.
     *
     * IRC-Syntax: PRIVMSG [#channel]or[user] : [message]
     */
    public function command()
    {

        $this->bot->log("Fetching excuse.");

        $data = $this->fetch($this->url);

        preg_match('/>([^<]+)<\/a><\/center>/', $data, $match);

        $excuse = False;

        if (!empty($match))
            $excuse = trim($match[1]);

        if ($excuse) {
            $this->say($excuse);
            return;
        }

        $this->say("It was working in my head");
    }
}
