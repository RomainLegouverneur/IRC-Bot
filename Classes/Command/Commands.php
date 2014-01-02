<?php
// Namespace
namespace Command;

/**
 * Sends the arguments to the channel
 *
 * @package IRCBot
 * @subpackage Command
 * @author Terry Matula <terrymatula@gmail.com>
 */
class Commands extends \Library\IRC\Command\Base {
	/**
	* The command's help text.
	*
	* @var string
	*/
	protected $help = '!commands';

	/**
	 * The number of arguments the command needs.
	 *
	 * You have to define this in the command.
	 *
	 * @var integer
	 */
	protected $numberOfArguments = 0;

	/**
	 * Sends the arguments to the channel, like say from a user.
	 *
	 */
	public function command() {
		$commands = implode(', !', array_keys($this->bot->getCommands()));
		$this->say("Try following commands: !" . strtolower($commands));
		return;
	}
}
?>