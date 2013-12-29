<?php

// Namespace

namespace Command;

/**
 * Execute php code.
 *
 * @package IRCBot
 * @subpackage Command
 * @author David <david@d4v1d.nl>
 */
class Php extends \Library\IRC\Command\Base
{

        /**
         * The command's help text.
         *
         * @var string
         */
        protected $help = '!php <code>';

        /**
         * Infinte arguments
         *
         * @var integer
         */
        protected $numberOfArguments = -1;

        /**
         * The directory to run the php scripts..
         * @var string
         */
        protected $execDir;

        /**
         * The result of the executed code
         * @var array
         */
        protected $result;

        /**
         * The exit code
         * @var int
         */
        protected $exitCode;

        /**
         * If we're using eval() this is used as a buffer to catch the output..
         * @var string
         */
        protected $evalBuffer;

        /**
         * Executes PHP code.
         */
        public function command()
        {
                // Are we allowed?
               // if ( !\Library\FunctionCollection::authed( $this->getUserIp() ) )
                 //       return false;

                if ( $this->arguments[ 0 ] == 'eval:' )
                {
                        $this->result = $this->run_eval( implode( ' ', array_slice( $this->arguments, 1 ) ) );
                }
                else
                {
                        if ( !is_writable( $this->execDir ) )
                        {
                                $this->bot->log( "Cannot write to PHP exec dir..: " . $this->execDir, 'DEBUG' );
                                $this->say( "PHP exec dir is not writable.." );
                                return false;
                        }

                        // Cleaning old scripts, in case there is any still.. 
                        #array_map( "unlink", glob( $this->execDir . '/*.php' ) );

                        $this->result = $this->run( implode( ' ', $this->arguments ) );
                }

                //$pastebin = \Library\Pastebin;
                //
                // outputs to IRC
                // .
                // TODO: pastebin if it's a long output.
                foreach ( $this->result as $line )
                {
                        $this->say( $line );
                }
        }

        public function __construct( $execDir )
        {
                if ( empty( $execDir ) )
                {
                        throw new \Exception( 'Invalid arguments' );
                }

                // Set the dir to run PHP scripts from.
                $this->execDir = $execDir;
        }

        /**
         * Runs PHP code from a file
         * 
         * @param string $code The PHP code
         * @return array an array with the output, one line per key.. 
         */
        protected function run( $code )
        {
                // Just preparing, netbeans will give some stupid warnings if I do not do this..
                $lines = array( );

                // The filename..
                $file = $this->execDir . "/" . time() . ".php";

                // If writing fails do nothing..
                if ( file_put_contents( $file, "<?php " . $code . " ?>" ) === false )
                {
                        $this->bot->log( "Unable to write PHP exec file: " . $file, 'DEBUG' );
                        return false;
                }

                // The CMD
                $cmd = 'php ' . escapeshellarg( $file ) . ' 2>&1';

                // Log stuff ^^
                $this->bot->log( "Executing php code: " . $cmd, 'DEBUG' );

                // And run it!
                exec( $cmd, $lines, $this->exitCode );

                // Return an array, one line per key.
                return $lines;
        }

        /**
         * Runs PHP code with eval()
         * 
         * @param string $code The PHP code
         * @return array an array with the output, one line per key.. 
         */
        protected function run_eval( $code )
        {
                // Start a buffer to get the eval() output
                ob_start();

                // Run the code
                eval( $code );

                // Put the result in a variable and stop the buffer
                $this->buffer = ob_get_contents();
                ob_end_clean();

                // Return an array, one line per key
                return explode( "\n", $this->buffer );
        }

}

?>