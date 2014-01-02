<?php
// Namespace
namespace Command;

/**
 * Restarts the bot.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Super3 <admin@wildphp.com>
 */
class Restart extends \Library\IRC\Command\Base {
	/**
	* The command's help text.
	*
	* @var string
	*/
	protected $help = '!restart';

	/**
	 * Restarts the bot.
	 */
	public function command() {
		// Are we allowed?
		if ( !\Library\FunctionCollection::authed( $this->getUserIp() ) )
		{
				$this->say("Not allowed");
				return false;
		}

		// Exit from Sever
		$this->connection->sendData('QUIT');
		
		shell_exec("stop phpbot404");
		sleep(1);
		shell_exec("start phpbot404");
		exit;
		// Reconnect to Server
		//$this->bot->connectToServer();
	}
}
?>
