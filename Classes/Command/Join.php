<?php
// Namespace
namespace Command;

/**
 * Joins the specified channel.
 * arguments[0] == Channel to join.
 *
 * @package IRCBot
 * @subpackage Command
 * @author Super3 <admin@wildphp.com>
 */
class Join extends \Library\IRC\Command\Base {
	/**
	* The command's help text.
	*
	* @var string
	*/
	protected $help = '!join [#channel]';


	/**
	 * The number of arguments the command needs.
	 *
	 * You have to define this in the command.
	 *
	 * @var integer
	 */
	protected $numberOfArguments = 1;

	/**
	 * Joins the specified channel.
	 *
	 * IRC-Syntax: JOIN [#channel]
	 */
	public function command() {
	// Are we allowed?
				if ( !\Library\FunctionCollection::authed( $this->getUserIp() ) )
				{
						$this->say("Not allowed");
						return false;
				}

		$this->connection->sendData('JOIN '.$this->arguments[0]);
	}
}
?>
