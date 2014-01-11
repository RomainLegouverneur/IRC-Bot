<?php
// Namespace
namespace Command;

/**
 * Returns a random Imgur.com URL to the chat
 *
 * @package IRCBot
 * @subpackage Command
 * @author Romain Legouverneur <romain.legouverneur@gmail.com>
 */
class Docs extends \Library\IRC\Command\Base {
                public $_default = 'php';

                public $_paths = array(
                        'php' => array(
                                'url' => 'http://php.net/',
                                'scrape' => array(
                                        'title' => 'p.refpurpose',
                                        'usage' => 'div.methodsynopsis'
                                )
                        )
                );

        /**
         * The command's help text.
         *
         * @var string
         */
        protected $help = '!docs [source|item] e.g., !docs isset (defaults to php.net)';

        /**
         * The number of arguments the command needs.
         *
         * @var integer
         */
        protected $numberOfArguments = -1;

        /**
         * Get random Imgur URL and return it.
                 */
        public function command() {
                        include(getcwd().'/Vendor/simple_html_dom.php');

                        $out = NULL;

                        $handle = $this->_paths[$this->_default];

                        if (isset($this->_paths[$this->arguments[0]]) AND isset($this->arguments[1])) {
                                $handle = $this->_paths[$this->arguments[0]];
                                $cmd = $this->arguments[1];
                        } else {
                                $cmd = $this->arguments[0];
                        }

                        $full_path = implode(NULL, array($handle['url'], $cmd));

                        $this->say("You're welcome: $full_path, real integration coming soon.");
        }

                public function _get_manual_body($path) {
                        $ch = curl_init($path);

                        curl_setopt_array($ch, array(
                                CURLOPT_FOLLOWLOCATION => TRUE,
                                CURLOPT_RETURNTRANSFER => TRUE,
                                CURLOPT_HEADER => FALSE
                        ));

                        $body = curl_exec($ch);

                        curl_close($ch);

                        return $body;
                }
}
?>
