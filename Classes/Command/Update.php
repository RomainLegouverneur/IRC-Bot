<?php
// Namespace
namespace Command;

/**
 * Update bot
 *
 * @package IRCBot
 * @subpackage Command
 * @author Romain Legouverneur <romain.legouverneur@gmail.com>
 */
class Update extends \Library\IRC\Command\Base {
    /**
    * The command's help text.
    *
    * @var string
    */
    protected $help = '!update';

    /**
     * The number of arguments the command needs.
     *
     * You have to define this in the command.
     *
     * @var integer
     */
    protected $numberOfArguments = 0;

    /**
     * Sends the arguments to the channel
     *
     */
    public function command() 
    {
        $this->say("Update in progress");
        shell_exec("git pull");
        $this->say("Update done");
        
        //Todo
        // $args = restart/rehash;
        return;
    }
}
